<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Limpieza Pública</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              50:  '#f0fdf4',
              100: '#dcfce7',
              200: '#bbf7d0',
              300: '#86efac',
              400: '#4ade80',
              500: '#22c55e',
              600: '#16a34a',
              700: '#15803d',
              800: '#166534',
              900: '#14532d',
              950: '#052e16',
            },
            slate: {
              950: '#020617',
            }
          },
          fontFamily: {
            heading: ['"Barlow Condensed"', 'sans-serif'],
            body:    ['"Barlow"', 'sans-serif'],
          },
        }
      }
    }
  </script>
  <style>
    * { box-sizing: border-box; }
    body { font-family: 'Barlow', sans-serif; }
    h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Barlow Condensed', sans-serif; }

    /* Sidebar transition */
    #sidebar {
      transition: transform 0.3s ease, width 0.3s ease;
    }
    #sidebar.collapsed {
      transform: translateX(-100%);
    }

    /* Overlay */
    #sidebar-overlay {
      transition: opacity 0.3s ease;
    }

    /* Active nav item */
    .nav-item.active {
      background-color: rgba(34,197,94,0.15);
      border-left: 3px solid #22c55e;
      color: #22c55e;
    }
    .nav-item:not(.active):hover {
      background-color: rgba(255,255,255,0.05);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: #0f172a; }
    ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }

    /* Form inputs */
    .form-input {
      background: #1e293b;
      border: 1px solid #334155;
      color: #e2e8f0;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-input:focus {
      outline: none;
      border-color: #22c55e;
      box-shadow: 0 0 0 3px rgba(34,197,94,0.15);
    }
    .form-input::placeholder { color: #475569; }

    /* Select arrow custom */
    .form-select {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%2322c55e' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.6rem center;
      background-size: 1.2em;
      padding-right: 2.2rem;
      appearance: none;
    }

    /* Required dot */
    .req-dot::before {
      content: '';
      display: inline-block;
      width: 8px; height: 8px;
      background: #ef4444;
      border-radius: 50%;
      margin-right: 6px;
      vertical-align: middle;
      position: relative; top: -1px;
    }

    /* Truck animation on the header */
    @keyframes drive {
      0%   { transform: translateX(-60px); opacity: 0; }
      10%  { opacity: 1; }
      90%  { opacity: 1; }
      100% { transform: translateX(0px); opacity: 1; }
    }
    .truck-animate { animation: drive 0.7s ease-out forwards; }

    /* Section fade-in */
    .section-fade { animation: fadeUp 0.4s ease-out both; }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Colonies table */
    .colonies-row:nth-child(odd) { background: rgba(255,255,255,0.03); }
    .colonies-row:hover { background: rgba(34,197,94,0.07); }

    /* Stat card hover */
    .stat-card { transition: transform 0.2s, box-shadow 0.2s; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.3); }
  </style>
</head>
<body class="bg-slate-950 text-slate-200 min-h-screen flex flex-col">

<!-- ═══════════════════════════════════════════
     SIDEBAR OVERLAY (mobile)
════════════════════════════════════════════ -->
<div id="sidebar-overlay"
     class="fixed inset-0 bg-black/60 z-20 hidden opacity-0"
     onclick="closeSidebar()">
</div>

<!-- ═══════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════ -->
<aside id="sidebar"
       class="fixed top-0 left-0 h-full w-64 bg-slate-900 border-r border-slate-800 z-30 flex flex-col
              md:translate-x-0 -translate-x-full">

  <!-- Sidebar brand -->
  <div class="flex items-center gap-3 px-5 py-5 border-b border-slate-800">
    <div class="w-9 h-9 rounded-lg bg-brand-700 flex items-center justify-center flex-shrink-0">
      <svg class="w-5 h-5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
      </svg>
    </div>
    <div>
      <p class="font-heading text-base font-700 text-white tracking-wide leading-tight">LIMPIEZA</p>
      <p class="font-heading text-xs text-slate-400 tracking-widest uppercase">Pública Municipal</p>
    </div>
  </div>

  <!-- Nav -->
  <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto" aria-label="Menú lateral">
    <p class="px-3 mb-3 text-xs font-semibold text-slate-500 tracking-widest uppercase">Menú</p>

    <button onclick="showSection('inicio')"
            id="nav-inicio"
            class="nav-item active w-full flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium text-left cursor-pointer transition-all">
      <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
      </svg>
      Inicio
    </button>

    <button onclick="showSection('formulario')"
            id="nav-formulario"
            class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium text-slate-400 text-left cursor-pointer transition-all">
      <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
      </svg>
      Formulario
    </button>
  </nav>

  <!-- Sidebar footer -->
  <div class="px-4 py-4 border-t border-slate-800">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-full bg-brand-800 flex items-center justify-center text-brand-300 font-heading font-bold text-sm">A</div>
      <div>
        <p class="text-xs font-semibold text-slate-300">Administrador</p>
        <p class="text-xs text-slate-500">admin@municipio.gob</p>
      </div>
    </div>
  </div>
</aside>

<!-- ═══════════════════════════════════════════
     MAIN WRAPPER (shifts right on md+)
════════════════════════════════════════════ -->
<div class="flex flex-col flex-1 md:ml-64">

  <!-- ═══════════════ HEADER ════════════════ -->
  <header class="sticky top-0 z-10 bg-slate-900/80 backdrop-blur border-b border-slate-800">
    <div class="flex items-center justify-between px-4 h-14">

      <!-- Left: hamburger + brand -->
      <div class="flex items-center gap-3">
        <!-- Hamburger (mobile only) -->
        <button id="hamburger-btn"
                onclick="toggleSidebar()"
                aria-label="Abrir menú"
                class="md:hidden p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
          <svg id="icon-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg id="icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

        <!-- Logo mark (desktop) -->
        <span class="truck-animate hidden md:flex items-center gap-2">
          <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4zM1 1h4l2.68 13.39a2 2 0 001.98 1.61h9.72a2 2 0 001.98-1.61L23 6H6"/>
          </svg>
          <span class="font-heading text-lg font-700 text-white tracking-wider">SISLIP</span>
        </span>
      </div>

      <!-- Center: nav -->
      <nav aria-label="Menú principal" class="hidden sm:flex items-center gap-1">
        <button onclick="showSection('inicio')"
                class="header-nav-btn px-4 py-1.5 rounded text-sm font-medium text-brand-400 hover:bg-slate-800 transition-colors">
          Inicio
        </button>
      </nav>

      <!-- Right: date badge -->
      <div class="flex items-center gap-3">
        <span id="header-date" class="text-xs text-slate-500 hidden sm:block"></span>
        <div class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></div>
      </div>
    </div>
  </header>

  <!-- ═══════════════ MAIN ═════════════════ -->
  <main class="flex-1 px-4 sm:px-6 py-6">

    <!-- ──────────── SECCIÓN: INICIO ──────────── -->
    <section id="section-inicio" class="section-fade">

      <!-- Page title -->
      <div class="mb-8">
        <h1 class="font-heading text-3xl sm:text-4xl font-800 text-white tracking-wide">
          Panel de Control
        </h1>
        <p class="text-slate-400 text-sm mt-1">
          Sistema de Registro de Actividades de Limpieza Pública Municipal
        </p>
      </div>

      <!-- Stat cards -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <article class="stat-card bg-slate-900 border border-slate-800 rounded-xl p-4">
          <div class="flex items-start justify-between mb-3">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Registros hoy</p>
            <span class="w-7 h-7 rounded-lg bg-brand-950 flex items-center justify-center">
              <svg class="w-3.5 h-3.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </span>
          </div>
          <p class="font-heading text-3xl font-700 text-white">14</p>
          <p class="text-xs text-brand-500 mt-1">↑ 3 más que ayer</p>
        </article>

        <article class="stat-card bg-slate-900 border border-slate-800 rounded-xl p-4">
          <div class="flex items-start justify-between mb-3">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Rutas activas</p>
            <span class="w-7 h-7 rounded-lg bg-blue-950 flex items-center justify-center">
              <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
              </svg>
            </span>
          </div>
          <p class="font-heading text-3xl font-700 text-white">8</p>
          <p class="text-xs text-blue-400 mt-1">En operación</p>
        </article>

        <article class="stat-card bg-slate-900 border border-slate-800 rounded-xl p-4">
          <div class="flex items-start justify-between mb-3">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Unidades</p>
            <span class="w-7 h-7 rounded-lg bg-amber-950 flex items-center justify-center">
              <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4zM1 1h4l2.68 13.39a2 2 0 001.98 1.61h9.72a2 2 0 001.98-1.61L23 6H6"/>
              </svg>
            </span>
          </div>
          <p class="font-heading text-3xl font-700 text-white">12</p>
          <p class="text-xs text-amber-400 mt-1">2 en mantenimiento</p>
        </article>

        <article class="stat-card bg-slate-900 border border-slate-800 rounded-xl p-4">
          <div class="flex items-start justify-between mb-3">
            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Colonias atendidas</p>
            <span class="w-7 h-7 rounded-lg bg-purple-950 flex items-center justify-center">
              <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </span>
          </div>
          <p class="font-heading text-3xl font-700 text-white">37</p>
          <p class="text-xs text-purple-400 mt-1">De 42 totales</p>
        </article>

      </div>

      <!-- Recent records table -->
      <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-800">
          <h2 class="font-heading text-xl font-700 text-white tracking-wide">Registros Recientes</h2>
          <button onclick="showSection('formulario')"
                  class="flex items-center gap-2 px-3 py-1.5 bg-brand-700 hover:bg-brand-600 text-white text-xs font-semibold rounded-lg transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nuevo registro
          </button>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-slate-800">
                <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Fecha</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Ruta</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Chofer</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Turno</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Km recorridos</th>
                <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Estado</th>
              </tr>
            </thead>
            <tbody>
              <tr class="colonies-row border-b border-slate-800/50">
                <td class="px-5 py-3 text-slate-300">15/04/2026</td>
                <td class="px-5 py-3 text-brand-400 font-medium">R-01 Norte</td>
                <td class="px-5 py-3 text-slate-300 hidden sm:table-cell">J. García</td>
                <td class="px-5 py-3 text-slate-400 hidden md:table-cell">Matutino</td>
                <td class="px-5 py-3 text-slate-400 hidden lg:table-cell">48 km</td>
                <td class="px-5 py-3"><span class="px-2 py-0.5 bg-brand-950 text-brand-400 text-xs rounded-full font-medium">Completado</span></td>
              </tr>
              <tr class="colonies-row border-b border-slate-800/50">
                <td class="px-5 py-3 text-slate-300">15/04/2026</td>
                <td class="px-5 py-3 text-brand-400 font-medium">R-03 Sur</td>
                <td class="px-5 py-3 text-slate-300 hidden sm:table-cell">M. López</td>
                <td class="px-5 py-3 text-slate-400 hidden md:table-cell">Vespertino</td>
                <td class="px-5 py-3 text-slate-400 hidden lg:table-cell">61 km</td>
                <td class="px-5 py-3"><span class="px-2 py-0.5 bg-amber-950 text-amber-400 text-xs rounded-full font-medium">En curso</span></td>
              </tr>
              <tr class="colonies-row border-b border-slate-800/50">
                <td class="px-5 py-3 text-slate-300">14/04/2026</td>
                <td class="px-5 py-3 text-brand-400 font-medium">R-07 Centro</td>
                <td class="px-5 py-3 text-slate-300 hidden sm:table-cell">A. Martínez</td>
                <td class="px-5 py-3 text-slate-400 hidden md:table-cell">Matutino</td>
                <td class="px-5 py-3 text-slate-400 hidden lg:table-cell">37 km</td>
                <td class="px-5 py-3"><span class="px-2 py-0.5 bg-brand-950 text-brand-400 text-xs rounded-full font-medium">Completado</span></td>
              </tr>
              <tr class="colonies-row border-b border-slate-800/50">
                <td class="px-5 py-3 text-slate-300">14/04/2026</td>
                <td class="px-5 py-3 text-brand-400 font-medium">R-05 Oriente</td>
                <td class="px-5 py-3 text-slate-300 hidden sm:table-cell">R. Hernández</td>
                <td class="px-5 py-3 text-slate-400 hidden md:table-cell">Nocturno</td>
                <td class="px-5 py-3 text-slate-400 hidden lg:table-cell">52 km</td>
                <td class="px-5 py-3"><span class="px-2 py-0.5 bg-red-950 text-red-400 text-xs rounded-full font-medium">Cancelado</span></td>
              </tr>
              <tr class="colonies-row">
                <td class="px-5 py-3 text-slate-300">13/04/2026</td>
                <td class="px-5 py-3 text-brand-400 font-medium">R-02 Poniente</td>
                <td class="px-5 py-3 text-slate-300 hidden sm:table-cell">C. Ramírez</td>
                <td class="px-5 py-3 text-slate-400 hidden md:table-cell">Matutino</td>
                <td class="px-5 py-3 text-slate-400 hidden lg:table-cell">44 km</td>
                <td class="px-5 py-3"><span class="px-2 py-0.5 bg-brand-950 text-brand-400 text-xs rounded-full font-medium">Completado</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </section>

    <!-- ──────────── SECCIÓN: FORMULARIO ──────────── -->
    <section id="section-formulario" class="section-fade hidden">

      <!-- Page title -->
      <div class="mb-7">
        <h1 class="font-heading text-3xl sm:text-4xl font-800 text-white tracking-wide">
          Registro de Actividad
        </h1>
        <p class="text-slate-400 text-sm mt-1">
          Actividades de Limpieza Pública — Complete todos los campos requeridos
          <span class="req-dot ml-3 text-xs text-red-400">Campo requerido</span>
        </p>
      </div>

      <form id="main-form" onsubmit="handleSubmit(event)" novalidate
            class="space-y-6">

        <!-- ── Bloque 1: Datos generales ── -->
        <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5">
          <legend class="font-heading text-base font-700 text-brand-400 tracking-wide px-2 uppercase">
            Datos Generales
          </legend>

          <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <!-- Fecha de orden -->
            <div>
              <label for="fecha_orden" class="req-dot block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Fecha de orden
              </label>
              <input type="date" id="fecha_orden" name="fecha_orden" required
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <!-- Fecha y hora de captura -->
            <div>
              <label for="fecha_captura" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Fecha y hora de captura
              </label>
              <input type="datetime-local" id="fecha_captura" name="fecha_captura"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <!-- Turno -->
            <div>
              <label for="turno" class="req-dot block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Turno
              </label>
              <select id="turno" name="turno" required
                      class="form-input form-select w-full rounded-lg px-3 py-2 text-sm">
                <option value="" disabled selected>Seleccionar…</option>
                <option value="matutino">Matutino</option>
                <option value="vespertino">Vespertino</option>
                <option value="nocturno">Nocturno</option>
              </select>
            </div>

            <!-- Ruta -->
            <div>
              <label for="ruta" class="req-dot block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Ruta
              </label>
              <select id="ruta" name="ruta" required
                      class="form-input form-select w-full rounded-lg px-3 py-2 text-sm">
                <option value="" disabled selected>Tabla…</option>
                <option value="r01">R-01 Norte</option>
                <option value="r02">R-02 Poniente</option>
                <option value="r03">R-03 Sur</option>
                <option value="r04">R-04 Oriente</option>
                <option value="r05">R-05 Centro</option>
              </select>
            </div>

          </div>
        </fieldset>

        <!-- ── Bloque 2: Personal y unidad ── -->
        <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5">
          <legend class="font-heading text-base font-700 text-brand-400 tracking-wide px-2 uppercase">
            Personal y Unidad
          </legend>

          <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <!-- Despachador -->
            <div>
              <label for="despachador" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Despachador
              </label>
              <select id="despachador" name="despachador"
                      class="form-input form-select w-full rounded-lg px-3 py-2 text-sm">
                <option value="" disabled selected>Tabla…</option>
                <option value="d1">Luis Torres</option>
                <option value="d2">Ana Flores</option>
                <option value="d3">Pedro Sánchez</option>
              </select>
            </div>

            <!-- Chofer -->
            <div>
              <label for="chofer" class="req-dot block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Chofer
              </label>
              <select id="chofer" name="chofer" required
                      class="form-input form-select w-full rounded-lg px-3 py-2 text-sm">
                <option value="" disabled selected>Tabla…</option>
                <option value="c1">J. García</option>
                <option value="c2">M. López</option>
                <option value="c3">A. Martínez</option>
                <option value="c4">R. Hernández</option>
              </select>
            </div>

            <!-- Tipo de unidad -->
            <div>
              <label for="tipo_unidad" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Tipo Unidad
              </label>
              <select id="tipo_unidad" name="tipo_unidad"
                      class="form-input form-select w-full rounded-lg px-3 py-2 text-sm">
                <option value="" disabled selected>Tabla…</option>
                <option value="compactador">Compactador</option>
                <option value="volteo">Volteo</option>
                <option value="pickup">Pick-up</option>
              </select>
            </div>

            <!-- Unidades -->
            <div>
              <label for="unidades" class="req-dot block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Unidades
              </label>
              <select id="unidades" name="unidades" required
                      class="form-input form-select w-full rounded-lg px-3 py-2 text-sm">
                <option value="" disabled selected>Tabla…</option>
                <option value="u01">Unidad 01 - PBX-001</option>
                <option value="u02">Unidad 02 - PBX-002</option>
                <option value="u03">Unidad 03 - PBX-003</option>
                <option value="u04">Unidad 04 - PBX-004</option>
              </select>
            </div>

          </div>
        </fieldset>

        <!-- ── Bloque 3: Operación ── -->
        <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5">
          <legend class="font-heading text-base font-700 text-brand-400 tracking-wide px-2 uppercase">
            Datos de Operación
          </legend>

          <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <!-- Cantidad -->
            <div>
              <label for="cantidad" class="req-dot block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Cantidad
              </label>
              <input type="number" id="cantidad" name="cantidad" min="0" required placeholder="0"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <!-- Puches -->
            <div>
              <label for="puches" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Puches
              </label>
              <input type="number" id="puches" name="puches" min="0" placeholder="0"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <!-- Km al salir -->
            <div>
              <label for="km_salir" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Km al salir
              </label>
              <input type="number" id="km_salir" name="km_salir" min="0" placeholder="0"
                     oninput="calcKm()"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <!-- Km al regresar -->
            <div>
              <label for="km_regresar" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Km al regresar
              </label>
              <input type="number" id="km_regresar" name="km_regresar" min="0" placeholder="0"
                     oninput="calcKm()"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <!-- Km recorridos (auto) -->
            <div>
              <label for="km_recorridos" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Km recorridos <span class="text-brand-600 normal-case font-normal">(auto)</span>
              </label>
              <input type="number" id="km_recorridos" name="km_recorridos" readonly placeholder="—"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm bg-slate-800 cursor-not-allowed text-brand-400" />
            </div>

          </div>
        </fieldset>

        <!-- ── Bloque 4: Diesel ── -->
        <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5">
          <legend class="font-heading text-base font-700 text-brand-400 tracking-wide px-2 uppercase">
            Control de Diesel
          </legend>

          <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <div>
              <label for="diesel_inicial" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Diesel inicial (L)
              </label>
              <input type="number" id="diesel_inicial" name="diesel_inicial" min="0" placeholder="0"
                     oninput="calcDiesel()"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <div>
              <label for="diesel_final" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Diesel final (L)
              </label>
              <input type="number" id="diesel_final" name="diesel_final" min="0" placeholder="0"
                     oninput="calcDiesel()"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <div>
              <label for="diesel_cargado" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Diesel cargado (L)
              </label>
              <input type="number" id="diesel_cargado" name="diesel_cargado" min="0" placeholder="0"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <div>
              <label for="diesel_unidad" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
                Diesel en unidad <span class="text-brand-600 normal-case font-normal">(auto)</span>
              </label>
              <input type="number" id="diesel_unidad" name="diesel_unidad" readonly placeholder="—"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm bg-slate-800 cursor-not-allowed text-brand-400" />
            </div>

          </div>
        </fieldset>

        <!-- ── Bloque 5: Fecha / Estadística ── -->
        <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5">
          <legend class="font-heading text-base font-700 text-brand-400 tracking-wide px-2 uppercase">
            Estadística de Cobertura
          </legend>

          <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5">

            <div>
              <label for="anio" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Año</label>
              <input type="number" id="anio" name="anio" min="2000" max="2099" placeholder="2026"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <div>
              <label for="mes" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Mes</label>
              <select id="mes" name="mes" class="form-input form-select w-full rounded-lg px-3 py-2 text-sm">
                <option value="" disabled selected>—</option>
                <option>Enero</option><option>Febrero</option><option>Marzo</option>
                <option>Abril</option><option>Mayo</option><option>Junio</option>
                <option>Julio</option><option>Agosto</option><option>Septiembre</option>
                <option>Octubre</option><option>Noviembre</option><option>Diciembre</option>
              </select>
            </div>

            <div>
              <label for="dia" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Día</label>
              <input type="number" id="dia" name="dia" min="1" max="31" placeholder="1"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <div>
              <label for="suma" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Suma</label>
              <input type="number" id="suma" name="suma" min="0" placeholder="0"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <div>
              <label for="cant_colonias" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Cant. Colonias</label>
              <input type="number" id="cant_colonias" name="cant_colonias" min="0" placeholder="0"
                     oninput="calcPct()"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

            <div>
              <label for="pct_atendido" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">% Atendido</label>
              <input type="number" id="pct_atendido" name="pct_atendido" min="0" max="100" placeholder="0"
                     class="form-input w-full rounded-lg px-3 py-2 text-sm" />
            </div>

          </div>
        </fieldset>

        <!-- ── Bloque 6: Colonias de la ruta ── -->
        <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5">
          <legend class="font-heading text-base font-700 text-brand-400 tracking-wide px-2 uppercase">
            Colonias de la Ruta
          </legend>

          <p class="mt-2 mb-4 text-xs text-slate-500 italic">
            * El ID mostrado no corresponde al ID de la base de datos.
          </p>

          <!-- Colonies table -->
          <div class="overflow-x-auto rounded-lg border border-slate-800 mb-4">
            <table class="w-full text-sm" id="colonies-table">
              <thead>
                <tr class="border-b border-slate-800 bg-slate-800/50">
                  <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-12">#</th>
                  <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nombre</th>
                  <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-20">%</th>
                  <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Habitantes</th>
                  <th class="px-4 py-2.5 w-10"></th>
                </tr>
              </thead>
              <tbody id="colonies-body">
                <!-- rows inserted by JS -->
              </tbody>
            </table>
          </div>

          <button type="button" onclick="addColonyRow()"
                  class="flex items-center gap-2 px-3 py-1.5 border border-slate-700 hover:border-brand-600 text-slate-400 hover:text-brand-400 text-xs rounded-lg transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Agregar colonia
          </button>
        </fieldset>

        <!-- ── Actions ── -->
        <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-2 pb-4">
          <button type="button" onclick="resetForm()"
                  class="w-full sm:w-auto px-6 py-2.5 border border-slate-700 hover:border-slate-500 text-slate-400 hover:text-white text-sm font-semibold rounded-lg transition-colors">
            Limpiar formulario
          </button>
          <button type="submit"
                  class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-2.5 bg-brand-700 hover:bg-brand-600 active:bg-brand-800 text-white text-sm font-semibold rounded-lg transition-colors shadow-lg shadow-brand-900/40">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            GUARDAR
          </button>
        </div>

      </form>

      <!-- Toast notification -->
      <div id="toast"
           class="fixed bottom-6 right-6 z-50 hidden items-center gap-3
                  bg-brand-800 border border-brand-600 text-white px-5 py-3 rounded-xl shadow-2xl
                  text-sm font-medium">
        <svg class="w-5 h-5 text-brand-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Registro guardado exitosamente
      </div>

    </section>

  </main>

  <!-- ═══════════════ FOOTER ════════════════ -->
  <footer class="border-t border-slate-800 bg-slate-900 mt-auto">
    <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-500">
      <p class="font-heading tracking-wide uppercase">
        SISLIP — Sistema de Limpieza Pública Municipal
      </p>
      <p>© 2026 · Dirección de Servicios Públicos</p>
    </div>
  </footer>

</div><!-- /main wrapper -->

<!-- ══════════════════════════════════
     JAVASCRIPT
═══════════════════════════════════ -->
<script>
  /* ─── Date in header ─── */
  const dateEl = document.getElementById('header-date');
  if (dateEl) {
    const now = new Date();
    dateEl.textContent = now.toLocaleDateString('es-MX', {
      weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
  }

  /* ─── Sidebar toggle ─── */
  let sidebarOpen = false;
  const sidebar  = document.getElementById('sidebar');
  const overlay  = document.getElementById('sidebar-overlay');
  const iconOpen = document.getElementById('icon-open');
  const iconClose= document.getElementById('icon-close');

  function toggleSidebar() {
    sidebarOpen ? closeSidebar() : openSidebar();
  }
  function openSidebar() {
    sidebarOpen = true;
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
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

  /* ─── Section switcher ─── */
  function showSection(name) {
    ['inicio','formulario'].forEach(s => {
      const sec = document.getElementById('section-' + s);
      const nav = document.getElementById('nav-' + s);
      if (s === name) {
        sec.classList.remove('hidden');
        sec.classList.add('section-fade');
        nav && nav.classList.add('active');
        nav && nav.classList.remove('text-slate-400');
        nav && nav.classList.add('text-brand-400');
        setTimeout(() => sec.classList.remove('section-fade'), 400);
      } else {
        sec.classList.add('hidden');
        nav && nav.classList.remove('active');
        nav && nav.classList.remove('text-brand-400');
        nav && nav.classList.add('text-slate-400');
      }
    });
    // Close mobile sidebar on navigate
    if (window.innerWidth < 768) closeSidebar();
  }

  /* ─── Auto-calc: Km recorridos ─── */
  function calcKm() {
    const salir    = parseFloat(document.getElementById('km_salir').value) || 0;
    const regresar = parseFloat(document.getElementById('km_regresar').value) || 0;
    const result   = regresar - salir;
    document.getElementById('km_recorridos').value = result >= 0 ? result : '';
  }

  /* ─── Auto-calc: Diesel en unidad ─── */
  function calcDiesel() {
    const ini    = parseFloat(document.getElementById('diesel_inicial').value) || 0;
    const fin    = parseFloat(document.getElementById('diesel_final').value) || 0;
    const result = ini - fin;
    document.getElementById('diesel_unidad').value = result >= 0 ? result : '';
  }

  /* ─── Colonies table ─── */
  let colonyIndex = 1;
  function addColonyRow() {
    const tbody = document.getElementById('colonies-body');
    const tr = document.createElement('tr');
    tr.className = 'colonies-row border-b border-slate-800/40';
    tr.innerHTML = `
      <td class="px-4 py-2 text-slate-500 text-xs">${colonyIndex++}</td>
      <td class="px-2 py-1.5">
        <input type="text" placeholder="Nombre de colonia"
               class="form-input w-full rounded-md px-2.5 py-1.5 text-xs" />
      </td>
      <td class="px-2 py-1.5">
        <input type="number" min="0" max="100" placeholder="0"
               class="form-input w-full rounded-md px-2.5 py-1.5 text-xs" />
      </td>
      <td class="px-2 py-1.5">
        <input type="number" min="0" placeholder="0"
               class="form-input w-full rounded-md px-2.5 py-1.5 text-xs" />
      </td>
      <td class="px-2 py-1.5 text-center">
        <button type="button" onclick="this.closest('tr').remove()"
                class="text-slate-600 hover:text-red-400 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </td>
    `;
    tbody.appendChild(tr);
  }

  /* ─── Form submit ─── */
  function handleSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const requiredFields = form.querySelectorAll('[required]');
    let valid = true;
    requiredFields.forEach(f => {
      if (!f.value) {
        valid = false;
        f.classList.add('border-red-500');
        f.addEventListener('input', () => f.classList.remove('border-red-500'), { once: true });
      }
    });
    if (!valid) return;

    // Show toast
    const toast = document.getElementById('toast');
    toast.classList.remove('hidden');
    toast.classList.add('flex');
    setTimeout(() => {
      toast.classList.add('hidden');
      toast.classList.remove('flex');
    }, 3000);
  }

  /* ─── Reset form ─── */
  function resetForm() {
    document.getElementById('main-form').reset();
    document.getElementById('km_recorridos').value = '';
    document.getElementById('diesel_unidad').value = '';
    document.getElementById('colonies-body').innerHTML = '';
    colonyIndex = 1;
  }

  /* ─── Pre-fill today's date ─── */
  (function prefillDates() {
    const today = new Date();
    const yyyy  = today.getFullYear();
    const mm    = String(today.getMonth() + 1).padStart(2, '0');
    const dd    = String(today.getDate()).padStart(2, '0');
    const hh    = String(today.getHours()).padStart(2, '0');
    const min   = String(today.getMinutes()).padStart(2, '0');
    const fOrder = document.getElementById('fecha_orden');
    const fCap   = document.getElementById('fecha_captura');
    const fYear  = document.getElementById('anio');
    const fDay   = document.getElementById('dia');
    if (fOrder) fOrder.value = `${yyyy}-${mm}-${dd}`;
    if (fCap)   fCap.value   = `${yyyy}-${mm}-${dd}T${hh}:${min}`;
    if (fYear)  fYear.value  = yyyy;
    if (fDay)   fDay.value   = parseInt(dd);
  })();

  /* ─── Add one default colony row ─── */
  addColonyRow();
</script>
</body>
</html>