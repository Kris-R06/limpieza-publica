/**
 * sidebar.js
 * Lógica compartida: sidebar móvil + fecha en el header.
 * Ruta: public/js/sidebar.js
 */

// Esperamos a que todo el HTML esté cargado antes de ejecutar el script
document.addEventListener('DOMContentLoaded', () => {

    /* ── Fecha dinámica en el header ── */
    const dateEl = document.getElementById('header-date');
    if (dateEl) {
        dateEl.textContent = new Date().toLocaleDateString('es-MX', {
            weekday: 'long',
            year:    'numeric',
            month:   'long',
            day:     'numeric',
        });
    }

    /* ── Sidebar toggle (solo en móvil) ── */
    const sidebar      = document.getElementById('sidebar');
    const overlay      = document.getElementById('sidebar-overlay');
    const iconOpen     = document.getElementById('icon-open');
    const iconClose    = document.getElementById('icon-close');
    const hamburgerBtn = document.getElementById('hamburger-btn'); // Buscamos el botón

    let sidebarOpen = false;

    // Verificamos que los elementos existan en la página actual para evitar errores
    if (hamburgerBtn && sidebar && overlay) {
        
        // Asignamos el evento clic al botón
        hamburgerBtn.addEventListener('click', () => {
            sidebarOpen ? closeSidebar() : openSidebar();
        });

        // Asignamos el evento clic al fondo oscuro para cerrar
        overlay.addEventListener('click', closeSidebar);
    }

    function openSidebar() {
        sidebarOpen = true;
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        
        // Pequeño delay para que la transición de opacidad se dispare
        setTimeout(() => overlay.classList.remove('opacity-0'), 10);
        
        iconOpen.classList.add('hidden');
        iconClose.classList.remove('hidden');
    }

    function closeSidebar() {
        sidebarOpen = false;
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0');
        
        setTimeout(() => overlay.classList.add('hidden'), 300);
        
        iconOpen.classList.remove('hidden');
        iconClose.classList.add('hidden');
    }
});