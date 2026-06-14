<?php
require_once 'conexao.php';
require_once 'classes.php';

$auth = new Auth($pdo);
$auth->requireLogin();
?>
