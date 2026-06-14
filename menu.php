<?php
include_once 'validasessao.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">

<button class="btn-sidebar-abrir" onclick="abrirSidebar()" aria-label="Abrir menu lateral">
    &#9776; Menu
</button>

<div class="sidebar-overlay" id="overlay" onclick="fecharSidebar()"></div>

<nav class="sidebar" id="sidebar" aria-label="Menu lateral">
    <button class="btn-sidebar-fechar" onclick="fecharSidebar()" aria-label="Fechar menu">&times;</button>

    <h3 class="sidebar-titulo">Biblioteca<br>Clarice Lispector</h3>
    <hr class="sidebar-divisor">

    <ul class="sidebar-menu">
        <li><a href="index.html">Apresentação da biblioteca</a></li>
        <li><a href="livros.php">Lista de livros</a></li>
        <li><a href="historico.php">Histórico de empréstimos</a></li>
    </ul>

    <hr class="sidebar-divisor">

    <div class="sidebar-contato">
        <p class="sidebar-label">Bibliotecário</p>
        <p>Lázaro Tenório</p>
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

<nav class="navbar navbar-expand-lg" style="background-color:#59392b;">
    <div class="container">
        <a class="navbar-brand text-white font-weight-bold" href="index.html">Biblioteca Clarice Lispector</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'livros.php' ? 'active font-weight-bold' : '' ?>"
                    href="livros.php" style="color:#f0d9cc;">Acervo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'historico.php' ? 'active font-weight-bold' : '' ?>"
                    href="historico.php" style="color:#f0d9cc;">Meu Histórico</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <span class="mr-3" style="color:#f0d9cc; font-size:0.9rem;">
                    Olá, <?= htmlspecialchars($_SESSION['usuario'] ?? 'Usuário') ?>
                </span>
                <a href="sair.php" class="btn btn-sm btn-outline-light">Sair</a>
            </div>
        </div>
    </div>
</nav>

<script src="script.js"></script>
