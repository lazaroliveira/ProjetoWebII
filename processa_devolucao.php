<?php
require_once 'validasessao.php';
require_once 'conexao.php';
require_once 'classes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emprestimo_id = (int) ($_POST['emprestimo_id'] ?? 0);

    if ($emprestimo_id <= 0) {
        header('Location: historico.php?msg=Empréstimo inválido.');
        exit();
    }

    $biblioteca = new Biblioteca();
    $sucesso    = $biblioteca->devolver($pdo, $emprestimo_id);

    if ($sucesso) {
        header('Location: historico.php?msg=Livro devolvido com sucesso!');
    } else {
        header('Location: historico.php?msg=Erro ao registrar a devolução. Tente novamente.');
    }
    exit();
}

header('Location: historico.php');
exit();
?>
