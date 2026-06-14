<?php
require_once 'conexao.php';
require_once 'classes.php';

$auth = new Auth($pdo);

if ($auth->check()) {
    header('Location: livros.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca Clarice Lispector</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="btn-sidebar-abrir" onclick="abrirSidebar()" aria-label="Abrir menu lateral">
        &#9776; Menu
    </button>

    <div class="sidebar-overlay" id="overlay" onclick="fecharSidebar()"></div>

    <nav class="sidebar" id="sidebar" aria-label="Menu lateral">
        <button class="btn-sidebar-fechar" onclick="fecharSidebar()" aria-label="Fechar menu">&times;</button>

        <h3 class="sidebar-titulo">Biblioteca<br>Clarice Lispector</h3>
        <hr class="sidebar-divisor">

        <ul class="sidebar-menu">
            <li><a href="index.html">Menu</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>

        <hr class="sidebar-divisor">

        <div class="sidebar-contato">
            <p class="sidebar-label">Bibliotecário</p>
            <p>Lázaro</p>
            <p class="sidebar-label">E-mail</p>
            <p><a href="mailto:lazarobiblio@gmail.com">lazarobiblio@gmail.com</a></p>
            <p class="sidebar-label">Endereço</p>
            <p>IFPE – Campus Afogados da Ingazeira, PE</p>
        </div>

        <hr class="sidebar-divisor">

        <div class="sidebar-player">
        <p class="sidebar-label">Playlist do bibliotecário :D</p><br>
        <img src="img/playlist.jpg" alt="Ícone de música" class="sidebar-player-icon">
        <audio id="player" src="musica/playlist.mp3"></audio>

        <div class="player-controles">
            <button onclick="toggleMusica()" id="btn-play" class="btn-play">▶ Play</button>
            <input type="range" id="volume" min="0" max="1" step="0.05" value="0.5"
            oninput="document.getElementById('player').volume = this.value"
            title="Volume">
        </div>
        </div>
    </nav>
    <div class="login-wrap">
        <div class="login-card">
            <h2>Entrar no Sistema</h2>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-danger py-2" role="alert">
                    <?= htmlspecialchars($_GET['msg']) ?>
                </div>
            <?php endif; ?>

            <form action="validalogin.php" method="post">
                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Digite seu usuário" required autofocus>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>
                <button type="submit" class="btn-login">Entrar</button>
            </form>

            <div class="voltar">
                <a href="index.html">← Voltar para a página inicial</a>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
