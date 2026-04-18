<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $pageTitle ?? 'SISLIP — Limpieza Pública' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Fuentes --}}
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700;800&family=Barlow:wght@300;400;500;600&display=swap"
        rel="stylesheet" />

  {{-- Tailwind CDN — reemplazar con Vite en producción --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              50:  '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0',
              300: '#86efac', 400: '#4ade80', 500: '#22c55e',
              600: '#16a34a', 700: '#15803d', 800: '#166534',
              900: '#14532d', 950: '#052e16',
            },
            slate: { 950: '#020617' },
          },
          fontFamily: {
            heading: ['"Barlow Condensed"', 'sans-serif'],
            body:    ['"Barlow"', 'sans-serif'],
          },
          animation: {
            'drive':   'drive 0.7s ease-out forwards',
            'fade-up': 'fadeUp 0.4s ease-out both',
          },
          keyframes: {
            drive: {
              '0%':   { transform: 'translateX(-60px)', opacity: '0' },
              '10%':  { opacity: '1' },
              '90%':  { opacity: '1' },
              '100%': { transform: 'translateX(0)', opacity: '1' },
            },
            fadeUp: {
              from: { opacity: '0', transform: 'translateY(16px)' },
              to:   { opacity: '1', transform: 'translateY(0)' },
            },
          },
        },
      },
    }
  </script>
</head>
<body class="font-body bg-slate-950 text-slate-200 min-h-screen flex flex-col">

{{-- ═══════════════════════════════════
     OVERLAY SIDEBAR (móvil)
════════════════════════════════════ --}}
<div id="sidebar-overlay"
     onclick="closeSidebar()"
     class="fixed inset-0 bg-black/60 z-20 hidden opacity-0 transition-opacity duration-300">
</div>

{{-- ═══════════════════════════════════
     SIDEBAR
════════════════════════════════════ --}}
<aside id="sidebar"
       class="fixed top-0 left-0 h-full w-64 z-30 flex flex-col
              bg-slate-900 border-r border-slate-800
              transition-transform duration-300 ease-in-out
              -translate-x-full md:translate-x-0">

  {{-- Brand --}}
  <div class="flex items-center gap-3 px-5 py-5 border-b border-slate-800">
    <div class="w-9 h-9 rounded-lg bg-brand-700 flex items-center justify-center flex-shrink-0">
      <svg class="w-5 h-5 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
      </svg>
    </div>
    <div>
      <p class="font-heading text-base font-bold text-white tracking-wide leading-tight">LIMPIEZA</p>
      <p class="font-heading text-xs text-slate-400 tracking-widest uppercase">Pública Municipal</p>
    </div>
  </div>

  {{-- Navegación --}}
  <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto" aria-label="Menú lateral">
    <p class="px-3 mb-3 text-xs font-semibold text-slate-500 tracking-widest uppercase">Menú</p>

    <a href="#"
       @class([
         'flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-150 border-l-[3px]',
         'bg-brand-500/15 border-l-brand-500 text-brand-400'    =>  request()->routeIs('dashboard'),
         'border-l-transparent text-slate-400 hover:bg-white/5' => !request()->routeIs('dashboard'),
       ])>
      <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
      </svg>
      Inicio
    </a>

    <a href="#"
       @class([
         'flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-150 border-l-[3px]',
         'bg-brand-500/15 border-l-brand-500 text-brand-400'    =>  request()->routeIs('formulario'),
         'border-l-transparent text-slate-400 hover:bg-white/5' => !request()->routeIs('formulario'),
       ])>
      <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
      </svg>
      Formulario
    </a>
  </nav>

  {{-- Info de usuario --}}
  <div class="px-4 py-4 border-t border-slate-800">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-full bg-brand-800 flex items-center justify-center
                  text-brand-300 font-heading font-bold text-sm">
        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
      </div>
      <div>
        <p class="text-xs font-semibold text-slate-300">{{ auth()->user()->name  ?? 'Administrador' }}</p>
        <p class="text-xs text-slate-500">{{ auth()->user()->email ?? 'admin@municipio.gob' }}</p>
      </div>
    </div>
  </div>
</aside>

{{-- ═══════════════════════════════════
     WRAPPER PRINCIPAL
════════════════════════════════════ --}}
<div class="flex flex-col flex-1 md:ml-64">

  {{-- ══════════ HEADER ══════════ --}}
  <header class="sticky top-0 z-10 bg-slate-900/80 backdrop-blur border-b border-slate-800">
    <div class="flex items-center justify-between px-4 h-14">

      {{-- Izquierda: hamburguesa + logo --}}
      <div class="flex items-center gap-3">
        <button id="hamburger-btn"
                onclick="toggleSidebar()"
                aria-label="Abrir menú"
                class="md:hidden p-2 rounded-md text-slate-400
                       hover:text-white hover:bg-slate-800 transition-colors">
          <svg id="icon-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg id="icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

        <span class="hidden md:flex items-center gap-2 animate-drive">
          <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4zM1 1h4l2.68 13.39a2 2 0 001.98 1.61h9.72a2 2 0 001.98-1.61L23 6H6"/>
          </svg>
          <span class="font-heading text-lg font-bold text-white tracking-wider">SISLIP</span>
        </span>
      </div>

      {{-- Centro: nav principal --}}
      <nav aria-label="Menú principal" class="hidden sm:flex items-center gap-1">
        <a href="#"
           @class([
             'px-4 py-1.5 rounded text-sm font-medium transition-colors',
             'text-brand-400 bg-slate-800'                   =>  request()->routeIs('dashboard'),
             'text-slate-400 hover:bg-slate-800 hover:text-white' => !request()->routeIs('dashboard'),
           ])>
          Inicio
        </a>
      </nav>

      {{-- Derecha: fecha + indicador online --}}
      <div class="flex items-center gap-3">
        <span id="header-date" class="text-xs text-slate-500 hidden sm:block"></span>
        <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
      </div>
    </div>
  </header>

  {{-- ══════════ CONTENIDO INYECTADO POR CADA VISTA ══════════ --}}
  <main class="flex-1 px-4 sm:px-6 py-6">
    @yield('content')
    @include('partials.footer')