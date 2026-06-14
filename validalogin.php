<?php
require_once 'conexao.php';
require_once 'classes.php';

$auth = new Auth($pdo);

$usuario_input = $_POST['usuario'] ?? '';
$senha_input   = $_POST['senha']   ?? '';

if ($auth->login($usuario_input, $senha_input)) {
    header('Location: livros.php');
    exit();
} else {
    header('Location: login.php?msg=Login ou senha incorretos.');
    exit();
}
?>
