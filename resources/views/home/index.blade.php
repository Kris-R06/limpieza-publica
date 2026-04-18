@extends('layout.admin')
@section('content')

{{-- DASHBOARD --}}
<section class="animate-fade-up">

  {{-- Título --}}
  <div class="mb-8">
    <h1 class="font-heading text-3xl sm:text-4xl font-extrabold text-brand-850 tracking-wide">
      Panel de Control
    </h1>
    <p class="text-slate-500 text-sm mt-1">
      Sistema de Registro de Actividades de Limpieza Pública Municipal
    </p>
  </div>

  {{-- ── Tarjetas de estadísticas (Sin animaciones) ── --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    <article class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
      <div class="flex items-start justify-between mb-3">
        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Registros hoy</p>
        <span class="w-7 h-7 rounded-lg bg-brand-50 flex items-center justify-center">
          {{-- Ícono Phosphor: Portapapeles --}}
          <i class="ph ph-clipboard-text text-base text-brand-600"></i>
        </span>
      </div>
      <p class="font-heading text-3xl font-bold text-slate-900">{{ $registrosHoy ?? 14 }}</p>
      <p class="text-xs text-brand-600 mt-1 font-medium">↑ 3 más que ayer</p>
    </article>

    <article class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
      <div class="flex items-start justify-between mb-3">
        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Rutas activas</p>
        <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
          {{-- Ícono Phosphor: Mapa --}}
          <i class="ph ph-map-trifold text-base text-blue-600"></i>
        </span>
      </div>
      <p class="font-heading text-3xl font-bold text-slate-900">{{ $rutasActivas ?? 8 }}</p>
      <p class="text-xs text-blue-600 mt-1 font-medium">En operación</p>
    </article>

    <article class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
      <div class="flex items-start justify-between mb-3">
        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Unidades</p>
        <span class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
          {{-- Ícono Phosphor: Camión --}}
          <i class="ph ph-truck text-base text-amber-600"></i>
        </span>
      </div>
      <p class="font-heading text-3xl font-bold text-slate-900">{{ $totalUnidades ?? 12 }}</p>
      <p class="text-xs text-amber-600 mt-1 font-medium">2 en mantenimiento</p>
    </article>

    <article class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
      <div class="flex items-start justify-between mb-3">
        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Colonias atendidas</p>
        <span class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
          {{-- Ícono Phosphor: Pin de ubicación --}}
          <i class="ph ph-map-pin text-base text-purple-600"></i>
        </span>
      </div>
      <p class="font-heading text-3xl font-bold text-slate-900">{{ $coloniasAtendidas ?? 37 }}</p>
      <p class="text-xs text-purple-600 mt-1 font-medium">De {{ $totalColonias ?? 42 }} totales</p>
    </article>

  </div>

  {{-- ── Tabla de registros recientes ── --}}
  <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-gray-50/50">
      <h2 class="font-heading text-xl font-bold text-slate-900 tracking-wide">Registros Recientes</h2>
      
      {{-- Contenedor para agrupar los botones --}}
      <div class="flex items-center gap-3">
        <a href="#"
           class="flex items-center gap-2 px-3 py-1.5 bg-brand-600 hover:bg-brand-700
                  text-white text-xs font-semibold rounded-lg transition-colors shadow-sm">
          {{-- Ícono Phosphor: Suma --}}
          <i class="ph ph-plus text-base shrink-0"></i>
          Nuevo registro
        </a>
        <a href="#"
           class="flex items-center gap-2 px-3 py-1.5 bg-brand-600 hover:bg-brand-700
                  text-white text-xs font-semibold rounded-lg transition-colors shadow-sm">
          {{-- Ícono Phosphor: Lista --}}
          <i class="ph ph-list-bullets text-base shrink-0"></i>
          Ver registros
        </a>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-gray-200 bg-gray-50">
            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Fecha</th>
            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Ruta</th>
            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Chofer</th>
            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Turno</th>
            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Km recorridos</th>
            <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Estado</th>
          </tr>
        </thead>
        <tbody>
          @forelse($registros ?? [] as $registro)
            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
              <td class="px-5 py-3 text-slate-600">
                {{ \Carbon\Carbon::parse($registro->fecha_orden)->format('d/m/Y') }}
              </td>
              <td class="px-5 py-3 text-brand-700 font-medium">{{ $registro->ruta }}</td>
              <td class="px-5 py-3 text-slate-600 hidden sm:table-cell">{{ $registro->chofer }}</td>
              <td class="px-5 py-3 text-slate-500 hidden md:table-cell capitalize">{{ $registro->turno }}</td>
              <td class="px-5 py-3 text-slate-500 hidden lg:table-cell">{{ $registro->km_recorridos }} km</td>
              <td class="px-5 py-3">
                @php
                  $badgeClasses = match($registro->estado) {
                    'completado' => 'bg-brand-100 text-brand-700 border border-brand-200',
                    'en_curso'   => 'bg-amber-100 text-amber-700 border border-amber-200',
                    'cancelado'  => 'bg-red-100 text-red-700 border border-red-200',
                    default      => 'bg-gray-100 text-slate-600 border border-gray-200',
                  };
                @endphp
                <span class="px-2.5 py-1 {{ $badgeClasses }} text-xs rounded-full font-semibold capitalize tracking-wide">
                  {{ ucfirst(str_replace('_', ' ', $registro->estado)) }}
                </span>
              </td>
            </tr>
          @empty
            {{-- Filas de ejemplo --}}
            @foreach([
              ['15/04/2026', 'R-01 Norte',    'J. García',    'Matutino',   '48 km', 'Completado', 'bg-brand-100 text-brand-700 border-brand-200'],
              ['15/04/2026', 'R-03 Sur',      'M. López',     'Vespertino', '61 km', 'En curso',   'bg-amber-100 text-amber-700 border-amber-200'],
              ['14/04/2026', 'R-07 Centro',   'A. Martínez',  'Matutino',   '37 km', 'Completado', 'bg-brand-100 text-brand-700 border-brand-200'],
              ['14/04/2026', 'R-05 Oriente',  'R. Hernández', 'Nocturno',   '52 km', 'Cancelado',  'bg-red-100 text-red-700 border-red-200'],
              ['13/04/2026', 'R-02 Poniente', 'C. Ramírez',   'Matutino',   '44 km', 'Completado', 'bg-brand-100 text-brand-700 border-brand-200'],
            ] as [$fecha, $ruta, $chofer, $turno, $km, $estado, $badge])
              <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                <td class="px-5 py-3 text-slate-600">{{ $fecha }}</td>
                <td class="px-5 py-3 text-brand-700 font-medium">{{ $ruta }}</td>
                <td class="px-5 py-3 text-slate-600 hidden sm:table-cell">{{ $chofer }}</td>
                <td class="px-5 py-3 text-slate-500 hidden md:table-cell">{{ $turno }}</td>
                <td class="px-5 py-3 text-slate-500 hidden lg:table-cell">{{ $km }}</td>
                <td class="px-5 py-3">
                  <span class="px-2.5 py-1 {{ $badge }} border text-xs rounded-full font-semibold tracking-wide">
                    {{ $estado }}
                  </span>
                </td>
              </tr>
            @endforeach
          @endforelse
        </tbody>
      </table>
    </div>

  </div>

</section>
@endsection 