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
