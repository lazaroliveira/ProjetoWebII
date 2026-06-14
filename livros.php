<?php
include_once 'validasessao.php';
require_once  'classes.php';

$biblioteca        = new Biblioteca();
$livros            = $biblioteca->getLivros($pdo);
$emprestimosAtivos = Biblioteca::totalAtivos($pdo, $_SESSION['usuario_id']);

$capas = [
    'A hora da estrela'         => 'img/AHora.jpg',
    'Perto do coração selvagem' => 'img/Perto.jpg',
    'Água Viva'                 => 'img/Agua.jpg',
    'A Via Crucis do Corpo'     => 'img/AVia.jpg',
    'A Paixão Segundo G. H'     => 'img/APaixao.jpg',
    'A Maçã no Escuro'          => 'img/AMaca.jpg',
];

$descricoes = [
    'A hora da estrela'         => 'livrosdesc/hora.html',
    'Perto do coração selvagem' => 'livrosdesc/perto.html',
    'Água Viva'                 => 'livrosdesc/agua.html',
    'A Via Crucis do Corpo'     => 'livrosdesc/avia.html',
    'A Paixão Segundo G. H'     => 'livrosdesc/apaixao.html',
    'A Maçã no Escuro'          => 'livrosdesc/amaca.html',
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acervo - Biblioteca Clarice Lispector</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap mt-4 mb-3">
            <h2 class="pagina-titulo mb-0">Acervo de Livros</h2>
            <span class="badge-ativos"><?= $emprestimosAtivos ?> livro(s) em sua posse</span>
        </div>
        <br>
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['erro']) ?></div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($livros as $livro): ?>
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="livro-card">
                    <?php
                        $capa = $capas[$livro['titulo']] ?? 'img/bannerClarice.png';
                        $desc = $descricoes[$livro['titulo']] ?? '#';
                    ?>
                    <a href="<?= $desc ?>">
                        <img src="<?= $capa ?>"
                             alt="Capa de <?= htmlspecialchars($livro['titulo']) ?>"
                             style="cursor: pointer;">
                    </a>
                    <div class="livro-info">
                        <p class="livro-titulo"><?= htmlspecialchars($livro['titulo']) ?></p>
                        <p class="livro-autor"><?= htmlspecialchars($livro['autor']) ?></p>

                        <?php if ($livro['disponivel']): ?>
                            <span class="status-disponivel">Disponível</span>
                            <form action="processa_emprestimo.php" method="post">
                                <input type="hidden" name="livro_id" value="<?= $livro['id'] ?>">
                                <button type="submit" class="btn-emprestar">Pegar Emprestado</button>
                            </form>
                        <?php else: ?>
                            <span class="status-indisponivel">Emprestado</span>
                            <button class="btn-emprestar" disabled>Indisponível</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="container-fluid mt-4" id="Footer">
        <p>Biblioteca Clarice Lispector</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
