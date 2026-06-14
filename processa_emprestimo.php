<?php
require_once 'validasessao.php';
require_once 'conexao.php';
require_once 'classes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $livro_id   = (int) ($_POST['livro_id'] ?? 0);
    $usuario_id = (int) $_SESSION['usuario_id'];

    if ($livro_id <= 0) {
        header('Location: livros.php?erro=Selecione um livro válido.');
        exit();
    }

    if (!Biblioteca::livroDisponivel($pdo, $livro_id)) {
        header('Location: livros.php?erro=Este livro já está emprestado.');
        exit();
    }

    $biblioteca = new Biblioteca();
    $sucesso    = $biblioteca->pegarEmprestado($pdo, $usuario_id, $livro_id);

    if ($sucesso) {
        header('Location: historico.php?msg=Empréstimo realizado com sucesso!');
    } else {
        header('Location: livros.php?erro=Erro ao registrar o empréstimo. Tente novamente.');
    }
    exit();
}

header('Location: livros.php');
exit();
?>
