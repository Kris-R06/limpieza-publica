/**
 * formulario.js
 * Lógica exclusiva del formulario de registro de limpieza.
 * Ruta sugerida: public/js/formulario.js
 */

/* ── Auto-cálculo: Km recorridos ── */
function calcKm() {
  const salir    = parseFloat(document.getElementById('km_salir').value)    || 0;
  const regresar = parseFloat(document.getElementById('km_regresar').value) || 0;
  const result   = regresar - salir;
  document.getElementById('km_recorridos').value = result >= 0 ? result : '';
}

/* ── Auto-cálculo: Diesel en unidad ── */
function calcDiesel() {
  const ini    = parseFloat(document.getElementById('diesel_inicial').value) || 0;
  const fin    = parseFloat(document.getElementById('diesel_final').value)   || 0;
  const result = ini - fin;
  document.getElementById('diesel_unidad').value = result >= 0 ? result : '';
}

/* ── Tabla dinámica de colonias ── */
let colonyIndex = 1;

function addColonyRow() {
  const tbody = document.getElementById('colonies-body');
  const tr    = document.createElement('tr');

  tr.className = [
    'border-b border-slate-800/40',
    'odd:bg-white/[0.03]',
    'hover:bg-green-500/[0.07]',
    'transition-colors',
  ].join(' ');

  tr.innerHTML = `
    <td class="px-4 py-2 text-slate-500 text-xs select-none">${colonyIndex++}</td>

    <td class="px-2 py-1.5">
      <input type="text"
             name="colonias[][nombre]"
             placeholder="Nombre de colonia"
             class="w-full rounded-md px-2.5 py-1.5 text-xs
                    bg-slate-800 border border-slate-700 text-slate-200
                    placeholder:text-slate-500
                    focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500/20
                    transition-colors duration-200" />
    </td>

    <td class="px-2 py-1.5">
      <input type="number"
             name="colonias[][porcentaje]"
             min="0" max="100"
             placeholder="0"
             class="w-full rounded-md px-2.5 py-1.5 text-xs
                    bg-slate-800 border border-slate-700 text-slate-200
                    placeholder:text-slate-500
                    focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500/20
                    transition-colors duration-200" />
    </td>

    <td class="px-2 py-1.5">
      <input type="number"
             name="colonias[][habitantes]"
             min="0"
             placeholder="0"
             class="w-full rounded-md px-2.5 py-1.5 text-xs
                    bg-slate-800 border border-slate-700 text-slate-200
                    placeholder:text-slate-500
                    focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500/20
                    transition-colors duration-200" />
    </td>

    <td class="px-2 py-1.5 text-center">
      <button type="button"
              onclick="this.closest('tr').remove()"
              title="Eliminar fila"
              class="text-slate-600 hover:text-red-400 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </td>
  `;

  tbody.appendChild(tr);
}

/* ── Limpiar formulario ── */
function resetForm() {
  document.getElementById('main-form').reset();
  document.getElementById('km_recorridos').value     = '';
  document.getElementById('diesel_unidad').value     = '';
  document.getElementById('colonies-body').innerHTML = '';
  colonyIndex = 1;
  addColonyRow();
}

/* ── Pre-llenar fechas con el momento actual ── */
(function prefillDates() {
  const now  = new Date();
  const yyyy = now.getFullYear();
  const mm   = String(now.getMonth() + 1).padStart(2, '0');
  const dd   = String(now.getDate()).padStart(2, '0');
  const hh   = String(now.getHours()).padStart(2, '0');
  const min  = String(now.getMinutes()).padStart(2, '0');

  const fOrder = document.getElementById('fecha_orden');
  const fCap   = document.getElementById('fecha_captura');
  const fYear  = document.getElementById('anio');
  const fDay   = document.getElementById('dia');

  if (fOrder && !fOrder.value) fOrder.value = `${yyyy}-${mm}-${dd}`;
  if (fCap   && !fCap.value)   fCap.value   = `${yyyy}-${mm}-${dd}T${hh}:${min}`;
  if (fYear  && !fYear.value)  fYear.value  = yyyy;
  if (fDay   && !fDay.value)   fDay.value   = parseInt(dd, 10);
})();

/* ── Agregar una fila de colonia por defecto al cargar ── */
addColonyRow();