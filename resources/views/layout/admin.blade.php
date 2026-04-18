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
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              50:  '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0',
              300: '#86efac', 400: '#4ade80', 500: '#22c55e',
              600: '#16a34a', 700: '#15803d', 800: '#166534',
              900: '#14532d', 950: '#052e16', 850: '#15532E',
              1000: '#082112',
            },
            slate: { 950: '#020617' },
          },
          fontFamily: {
            // Para títulos, botones grandes y menús
            heading: ['"Barlow Condensed"', 'sans-serif'],
            // Para párrafos, tablas y textos normales
            body: ['"Barlow"', 'sans-serif'],
          },
          animation: {
            'fade-up': 'fadeUp 0.4s ease-out both',
          },
          keyframes: {
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
<body class="font-body bg-gray-50 text-slate-800 min-h-screen flex flex-col">

{{--OVERLAY SIDEBAR (móvil)--}}
<div id="sidebar-overlay"
     class="fixed inset-0 bg-black/40 z-20 hidden opacity-0 transition-opacity duration-300">
</div>

{{--SIDEBAR--}}
<aside id="sidebar"
       class="fixed top-0 left-0 h-full w-64 z-30 flex flex-col
              bg-brand-850 text-white shadow-xl
              transition-transform duration-300 ease-in-out
              -translate-x-full md:translate-x-0">

  {{-- Brand (Ajustado para fondo oscuro) --}}
  <div class="flex items-center gap-3 px-5 py-5 border-b border-brand-800/50">
    <div class="w-9 h-9 rounded-lg bg-brand-200 flex items-center justify-center shrink-0 border border-white">
      <i class="ph ph-trash text-xl text-brand-850"></i>
    </div>
    <div>
      <p class="font-heading text-xl font-bold text-white tracking-wide leading-tight uppercase">Sistema de Limpieza</p>
    </div>
  </div>

  {{-- Navegación (Ajustada para fondo oscuro) --}}
  <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto" aria-label="Menú lateral">
    <p class="px-3 mb-3 text-[10px] font-bold text-brand-400 tracking-[0.2em] uppercase">Menú Principal</p>

    {{-- Inicio --}}
    <a href="{{ route('home') }}"
       @class([
         'flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-150 border-l-[3px]',
         'bg-brand-800 border-l-brand-400 text-white shadow-inner' => request()->routeIs('home'),
         'border-l-transparent text-brand-100 hover:bg-brand-800/50 hover:text-white' => !request()->routeIs('home'),
       ])>
      <i class="ph ph-house text-lg shrink-0"></i>
      Inicio
    </a>

    {{-- Formulario --}}
    <a href="#"
       @class([
         'flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-150 border-l-[3px]',
         'bg-brand-800 border-l-brand-400 text-white shadow-inner' => request()->routeIs('formulario'),
         'border-l-transparent text-brand-100 hover:bg-brand-800/50 hover:text-white' => !request()->routeIs('formulario'),
       ])>
      <i class="ph ph-file-text text-lg shrink-0"></i>
      Formulario
    </a>
  </nav>

  {{-- Info de usuario (Pie del Sidebar) --}}
  <div class="px-4 py-4 border-t border-brand-800/50 bg-brand-950/30">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-full bg-brand-700 flex items-center justify-center
                  text-white font-heading font-bold text-sm border border-brand-500">
        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
      </div>
      <div class="overflow-hidden">
        <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name  ?? 'Administrador' }}</p>
        <p class="text-[10px] text-brand-400 truncate">{{ auth()->user()->email ?? 'admin@municipio.gob' }}</p>
      </div>
    </div>
  </div>
</aside>

{{-- WRAPPER PRINCIPAL --}}
  <div class="flex flex-col flex-1 md:ml-64">

  {{-- HEADER --}}
  <header class="sticky top-0 z-10 bg-brand-850 backdrop-blur border-b border-gray-200 shadow-sm">
    <div class="flex items-center justify-between px-4 h-14">

      {{-- Izquierda: hamburguesa --}}
      <div class="flex items-center gap-3 z-10">
        <button id="hamburger-btn"
                aria-label="Abrir menú"
                class="md:hidden p-2 rounded-md text-white hover:text-slate-900 hover:bg-gray-100 transition-colors">
          {{-- Ícono Phosphor: Abrir Menú (Se mantienen los IDs para tu JavaScript) --}}
          <i id="icon-open" class="ph ph-list text-xl"></i>
          
          {{-- Ícono Phosphor: Cerrar Menú --}}
          <i id="icon-close" class="ph ph-x text-xl hidden"></i>
        </button>
      </div>

      {{-- Centro: Título absoluto para alineación perfecta --}}
      <div class="absolute inset-x-0 top-0 h-14 flex items-center justify-center pointer-events-none">
          <span class="text-sm font-semibold text-white tracking-widest uppercase">
            Limpieza Pública Municipal De Mataranch
          </span>
      </div>

    </div>
  </header>

{{-- CONTENIDO INYECTADO DINÁMICAMENTE --}}
    <main class="flex-1 px-4 sm:px-6 py-6">
      @yield('content')
    </main>
    
    {{-- Inclusión del Footer --}}
    @include('partials.footer')

  </div>

  {{-- JS COMPARTIDO --}}
  <script src="{{ asset('js/sidebar.js') }}"></script>
  @stack('scripts')

</body>
</html>