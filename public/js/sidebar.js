/**
 * sidebar.js
 * Lógica para el sidebar móvil.
 * Ruta: public/js/sidebar.js
 */

document.addEventListener('DOMContentLoaded', () => {

    /* ── Sidebar toggle (solo en móvil) ── */
    const sidebar      = document.getElementById('sidebar');
    const overlay      = document.getElementById('sidebar-overlay');
    const iconOpen     = document.getElementById('icon-open');
    const iconClose    = document.getElementById('icon-close');
    const hamburgerBtn = document.getElementById('hamburger-btn');

    let sidebarOpen = false;

    // Verificamos que los elementos existan en la página actual para evitar errores
    if (hamburgerBtn && sidebar && overlay) {
        
        // Asignamos el evento clic al botón de hamburguesa
        hamburgerBtn.addEventListener('click', () => {
            sidebarOpen ? closeSidebar() : openSidebar();
        });

        // Asignamos el evento clic al fondo oscuro para cerrar el menú
        overlay.addEventListener('click', closeSidebar);
    }

    function openSidebar() {
        sidebarOpen = true;
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        
        // Pequeño delay para que la transición de opacidad se dispare
        setTimeout(() => overlay.classList.remove('opacity-0'), 10);
        
        if (iconOpen && iconClose) {
            iconOpen.classList.add('hidden');
            iconClose.classList.remove('hidden');
        }
    }

    function closeSidebar() {
        sidebarOpen = false;
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0');
        
        // Espera a que termine la animación de CSS antes de ocultarlo con 'hidden'
        setTimeout(() => overlay.classList.add('hidden'), 300);
        
        if (iconOpen && iconClose) {
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
        }
    }
});