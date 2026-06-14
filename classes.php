<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Auth
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function login(string $username, string $password): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $password == $user['senha']) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario'] = $user['nome'];
            $_SESSION['usuario_perfil'] = $user['perfil'];
            $_SESSION['logado'] = true;
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    public function check(): bool
    {
        return !empty($_SESSION['logado']);
    }

    public function requireLogin(): void
    {
        if (!$this->check()) {
            header('Location: login.php?msg=Faça login para acessar o sistema.');
            exit;
        }
    }

    public function currentUser(): ?string
    {
        return $this->check() ? (string) $_SESSION['usuario'] : null;
    }
}

trait AcoesEmprestimo
{
    public function pegarEmprestado(PDO $pdo, int $usuario_id, int $livro_id): bool
    {
        $stmt = $pdo->prepare("INSERT INTO emprestimos (usuario_id, livro_id) VALUES (?, ?)");
        $ok   = $stmt->execute([$usuario_id, $livro_id]);

        if ($ok) {
            $stmt2 = $pdo->prepare("UPDATE livros SET disponivel = 0 WHERE id = ?");
            $stmt2->execute([$livro_id]);
        }

        return $ok;
    }

    public function devolver(PDO $pdo, int $emprestimo_id): bool
    {
        $stmt = $pdo->prepare("UPDATE emprestimos SET data_devolucao = NOW() WHERE id = ?");
        $ok   = $stmt->execute([$emprestimo_id]);

        if ($ok) {
            $stmt2 = $pdo->prepare("
                UPDATE livros SET disponivel = 1
                WHERE id = (SELECT livro_id FROM emprestimos WHERE id = ?)
            ");
            $stmt2->execute([$emprestimo_id]);
        }

        return $ok;
    }
}

trait ConsultaAcervo
{
    public function getLivros(PDO $pdo): array
    {
        $stmt = $pdo->prepare("SELECT * FROM livros ORDER BY titulo ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getHistorico(PDO $pdo, int $usuario_id): array
    {
        $stmt = $pdo->prepare("
            SELECT
                e.id AS emprestimo_id,
                l.titulo,
                l.autor,
                e.data_emprestimo,
                e.data_devolucao
            FROM emprestimos e
            JOIN livros l ON l.id = e.livro_id
            WHERE e.usuario_id = ?
            ORDER BY e.data_emprestimo DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }
}

class Biblioteca
{
    use AcoesEmprestimo, ConsultaAcervo;

    public static function livroDisponivel(PDO $pdo, int $livro_id): bool
    {
        $stmt = $pdo->prepare("SELECT disponivel FROM livros WHERE id = ?");
        $stmt->execute([$livro_id]);
        $livro = $stmt->fetch();
        return $livro && $livro['disponivel'] == 1;
    }

    public static function totalAtivos(PDO $pdo, int $usuario_id): int
    {
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as total FROM emprestimos
            WHERE usuario_id = ? AND data_devolucao IS NULL
        ");
        $stmt->execute([$usuario_id]);
        $res = $stmt->fetch();
        return (int) ($res['total'] ?? 0);
    }
}
?>
