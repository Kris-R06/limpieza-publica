/**
 * sidebar.js
 * Lógica compartida: sidebar móvil + fecha en el header.
 * Ruta sugerida: public/js/sidebar.js
 */

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
let sidebarOpen = false;

const sidebar   = document.getElementById('sidebar');
const overlay   = document.getElementById('sidebar-overlay');
const iconOpen  = document.getElementById('icon-open');
const iconClose = document.getElementById('icon-close');

function toggleSidebar() {
  sidebarOpen ? closeSidebar() : openSidebar();
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