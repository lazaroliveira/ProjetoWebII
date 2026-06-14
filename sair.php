<?php
session_start();
session_unset();
session_destroy();

header('Location: index.html?msg=Você saiu com sucesso.');
die();
?>
