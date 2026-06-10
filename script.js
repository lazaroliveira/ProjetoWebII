function abrirSidebar() {
    document.getElementById('sidebar').classList.add('aberta');
    document.getElementById('overlay').classList.add('visivel');
    document.body.style.overflow = 'hidden';
}

function fecharSidebar() {
    document.getElementById('sidebar').classList.remove('aberta');
    document.getElementById('overlay').classList.remove('visivel');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') fecharSidebar();
});

function toggleMusica() {
    const player = document.getElementById('player');
    const btn = document.getElementById('btn-play');
    if (player.paused) {
        player.play();
        btn.textContent = '⏸ Pause';
    } else {
        player.pause();
        btn.textContent = '▶ Play';
    }
}
