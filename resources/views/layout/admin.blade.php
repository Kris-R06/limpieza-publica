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
  
  <style>
    html {
    font-size: 115%; 
    }
  </style>

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
            heading: ['"Barlow Condensed"', 'sans-serif'],
            body:    ['"Barlow"', 'sans-serif'],
          },
        },
      },
    }
  </script>
</head>
<body class="font-body bg-gray-50 text-slate-800 min-h-screen flex flex-col">
{{-- OVERLAY SIDEBAR --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 hidden opacity-0 transition-opacity duration-300"></div>

{{-- SIDEBAR --}}
<aside id="sidebar" class="fixed top-0 left-0 h-full w-64 z-50 flex flex-col bg-brand-850 text-white shadow-xl transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0">
  {{-- Brand --}}
  <div class="flex items-center gap-3 px-5 py-5 border-b border-brand-800/50">
    <div class="w-9 h-9 rounded-lg bg-brand-200 flex items-center justify-center shrink-0 border border-white">
      <i class="ph ph-trash text-xl text-brand-850"></i>
    </div>
    <p class="font-heading text-xl font-bold text-white tracking-wide leading-tight uppercase">Sistema de Limpieza</p>
  </div>

  {{-- Navegación --}}
	<nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">
		<p class="px-3 mb-3 text-md font-bold text-brand-400 tracking-[0.2em] uppercase">Menú Principal</p>
		<a href="{{ route('home') }}" 
		@class([
			'flex items-center gap-3 px-3 py-2.5 rounded-md text-lg font-medium transition-all duration-150 border-l-[3px]',
			'bg-brand-800 border-l-brand-400 text-white shadow-inner' => request()->routeIs('home'),
			'border-l-transparent text-brand-100 hover:bg-brand-800/50 hover:text-white' => !request()->routeIs('home'),
		])>
		<i class="ph ph-house text-xl"></i> Inicio
		</a>
		<a href="#" 
		@class([
			'flex items-center gap-3 px-3 py-2.5 rounded-md text-lg font-medium transition-all duration-150 border-l-[3px]',
			'bg-brand-800 border-l-brand-400 text-white shadow-inner' => request()->routeIs('formulario.*'),
			'border-l-transparent text-brand-100 hover:bg-brand-800/50 hover:text-white' => !request()->routeIs('formulario.*'),
		])>
		<i class="ph ph-file-text text-xl"></i> Formulario
		</a>
    <a href="{{ route('users.index') }}" 
		@class([
			'flex items-center gap-3 px-3 py-2.5 rounded-md text-lg font-medium transition-all duration-150 border-l-[3px]',
			'bg-brand-800 border-l-brand-400 text-white shadow-inner' => request()->routeIs('users.*'),
			'border-l-transparent text-brand-100 hover:bg-brand-800/50 hover:text-white' => !request()->routeIs('users.*'),
		])>
		<i class="ph ph-users text-xl"></i> Usuarios
		</a>
		<a href="{{ route('rutas.index') }}" 
		@class([
			'flex items-center gap-3 px-3 py-2.5 rounded-md text-lg font-medium transition-all duration-150 border-l-[3px]',
			'bg-brand-800 border-l-brand-400 text-white shadow-inner' => request()->routeIs('rutas.*'),
			'border-l-transparent text-brand-100 hover:bg-brand-800/50 hover:text-white' => !request()->routeIs('rutas.*'),
		])>
		<i class="ph ph-chart-bar text-xl"></i> Rutas
		</a>
    <a href="{{ route('turnos.index') }}"
    @class([
      'flex items-center gap-3 px-3 py-2.5 rounded-md text-lg font-medium transition-all duration-150 border-l-[3px]',
      'bg-brand-800 border-l-brand-400 text-white shadow-inner' => request()->routeIs('turnos.*'),
      'border-l-transparent text-brand-100 hover:bg-brand-800/50 hover:text-white' => !request()->routeIs('turnos.*'),
    ])>
    <i class="ph ph-clock-user text-xl"></i> Turnos
    </a>
    <a href="{{ route('tipo_unidades.index') }}"
		@class([
			'flex items-center gap-3 px-3 py-2.5 rounded-md text-lg font-medium transition-all duration-150 border-l-[3px]',
			'bg-brand-800 border-l-brand-400 text-white shadow-inner' => request()->routeIs('tipo_unidades.*'),
			'border-l-transparent text-brand-100 hover:bg-brand-800/50 hover:text-white' => !request()->routeIs('tipo_unidades.*'),
		])>
		<i class="ph ph-truck text-xl"></i> Tipos de Unidades
		</a>
    <a href="{{ route('tipo_trabajadores.index') }}"
    @class([
      'flex items-center gap-3 px-3 py-2.5 rounded-md text-lg font-medium transition-all duration-150 border-l-[3px]',
      'bg-brand-800 border-l-brand-400 text-white shadow-inner' => request()->routeIs('tipo_trabajadores.*'),
      'border-l-transparent text-brand-100 hover:bg-brand-800/50 hover:text-white' => !request()->routeIs('tipo_trabajadores.*'),
    ])>
    <i class="ph ph-hard-hat text-xl"></i> Tipos de Trabajadores
    </a>
    

		{{-- Separador Visual --}}
		<div class="my-4 border-t border-brand-800/50"></div>
		<form action="{{ route('logout') }}" method="POST">
		@csrf
		<button type="submit" 
				class="w-full text-left flex items-center gap-3 px-3 py-2.5 rounded-md text-lg font-medium border-l-[3px] border-l-transparent text-brand-100 hover:bg-red-500/20 hover:text-red-400 transition-colors group">
			<i class="ph ph-sign-out text-xl group-hover:translate-x-1 transition-transform"></i> 
			Cerrar sesión
		</button>
		</form>
	</nav>

  {{-- Info de usuario --}}
  <div class="px-4 py-4 border-t border-brand-800/50 bg-brand-950/30">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-full bg-brand-700 flex items-center justify-center text-white font-bold text-sm border border-brand-500">
        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
      </div>
      <div class="overflow-hidden">
        <p class="text-sm font-bold text-white truncate">{{ trim((auth()->user()->name ?? 'Administrador') . ' ' . (auth()->user()->lastname ?? '')) }}</p>
        <p class="text-xs text-brand-400 truncate">{{ auth()->user()->email ?? 'admin@municipio.gob' }}</p>
      </div>
    </div>
  </div>
</aside>

{{-- WRAPPER PRINCIPAL --}}
<div class="flex flex-col flex-1 md:ml-64 bg-gray-50 min-h-screen">
  {{-- 
    IMPORTANTE: No dejes espacios ni comentarios entre el DIV de arriba y el HEADER.
    El -mt-px es el "seguro de vida" contra la línea blanca.
  --}}
  <header class="sticky top-0 z-40 bg-brand-850 border-b border-brand-900/50 shadow-sm -mt-px">
    <div class="flex items-center justify-between px-4 h-14 relative">
      
      {{-- Izquierda: Hamburguesa --}}
      <div class="flex items-center z-10">
        <button id="hamburger-btn" class="md:hidden p-2 rounded-md text-white hover:bg-brand-800 transition-colors">
          <i id="icon-open" class="ph ph-list text-xl"></i>
          <i id="icon-close" class="ph ph-x text-xl hidden"></i>
        </button>
      </div>

      {{-- Centro: Título (Capa superior absoluta) --}}
      <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
          <span class="text-md font-bold text-brand-100 tracking-[0.2em] uppercase text-center px-10">
            Limpieza Pública Municipal De Mataranch
          </span>
      </div>
    </div>
  </header>

  {{-- CONTENIDO --}}
  <main class="flex-1 px-4 sm:px-6 py-6">
    @yield('content')
  </main>
  
  @include('partials.footer')
</div>

<script src="{{ asset('js/sidebar.js') }}"></script>
@stack('scripts')

</body>
</html>