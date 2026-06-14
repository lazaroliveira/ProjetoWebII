<?php
include_once 'validasessao.php';
require_once  'classes.php';

$biblioteca  = new Biblioteca();
$emprestimos = $biblioteca->getHistorico($pdo, $_SESSION['usuario_id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico - Biblioteca Clarice Lispector</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex flex-column" style="min-height:100vh;">
    <?php include 'menu.php'; ?>

    <div class="container flex-grow-1">
        <h2 class="pagina-titulo">Meu Histórico de Empréstimos</h2>
        <br>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered tabela-historico" style="border-radius: 25px; overflow: hidden;">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Data do Empréstimo</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($emprestimos) > 0): ?>
                        <?php foreach ($emprestimos as $emp): ?>
                        <?php
                            $devolvido   = $emp['data_devolucao'] !== null;
                            $statusTexto = $devolvido
                                ? 'Devolvido em ' . date('d/m/Y', strtotime($emp['data_devolucao']))
                                : 'Em sua posse';
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($emp['titulo']) ?></td>
                            <td><?= htmlspecialchars($emp['autor']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($emp['data_emprestimo'])) ?></td>
                            <td>
                                <span class="<?= $devolvido ? 'status-devolvido' : 'status-posse' ?>">
                                    <?= $statusTexto ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!$devolvido): ?>
                                    <form action="processa_devolucao.php" method="post">
                                        <input type="hidden" name="emprestimo_id" value="<?= $emp['emprestimo_id'] ?>">
                                        <button type="submit" class="btn-devolver">Devolver</button>
                                    </form>
                                <?php else: ?>
                                    <span style="color:#aaa;">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="vazio">Você ainda não pegou nenhum livro emprestado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="container-fluid mt-auto" id="Footer">
        <p>Biblioteca Clarice Lispector</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
