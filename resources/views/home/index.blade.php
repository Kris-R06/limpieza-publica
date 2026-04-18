{{-- resources/views/dashboard.blade.php --}}
@extends('layout.admin')
@section('content')

{{-- ══════════════════════════════════════════════
     DASHBOARD
═══════════════════════════════════════════════ --}}
<section class="animate-fade-up">

  {{-- Título --}}
  <div class="mb-8">
    <h1 class="font-heading text-3xl sm:text-4xl font-extrabold text-white tracking-wide">
      Panel de Control
    </h1>
    <p class="text-slate-400 text-sm mt-1">
      Sistema de Registro de Actividades de Limpieza Pública Municipal
    </p>
  </div>

  {{-- ── Tarjetas de estadísticas ── --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    <article class="bg-slate-900 border border-slate-800 rounded-xl p-4
                    hover:-translate-y-1 hover:shadow-2xl transition-all duration-200">
      <div class="flex items-start justify-between mb-3">
        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Registros hoy</p>
        <span class="w-7 h-7 rounded-lg bg-brand-950 flex items-center justify-center">
          <svg class="w-3.5 h-3.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
        </span>
      </div>
      <p class="font-heading text-3xl font-bold text-white">{{ $registrosHoy ?? 14 }}</p>
      <p class="text-xs text-brand-500 mt-1">↑ 3 más que ayer</p>
    </article>

    <article class="bg-slate-900 border border-slate-800 rounded-xl p-4
                    hover:-translate-y-1 hover:shadow-2xl transition-all duration-200">
      <div class="flex items-start justify-between mb-3">
        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Rutas activas</p>
        <span class="w-7 h-7 rounded-lg bg-blue-950 flex items-center justify-center">
          <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
          </svg>
        </span>
      </div>
      <p class="font-heading text-3xl font-bold text-white">{{ $rutasActivas ?? 8 }}</p>
      <p class="text-xs text-blue-400 mt-1">En operación</p>
    </article>

    <article class="bg-slate-900 border border-slate-800 rounded-xl p-4
                    hover:-translate-y-1 hover:shadow-2xl transition-all duration-200">
      <div class="flex items-start justify-between mb-3">
        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Unidades</p>
        <span class="w-7 h-7 rounded-lg bg-amber-950 flex items-center justify-center">
          <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 17a2 2 0 100-4 2 2 0 000 4zm8 0a2 2 0 100-4 2 2 0 000 4zM1 1h4l2.68 13.39a2 2 0 001.98 1.61h9.72a2 2 0 001.98-1.61L23 6H6"/>
          </svg>
        </span>
      </div>
      <p class="font-heading text-3xl font-bold text-white">{{ $totalUnidades ?? 12 }}</p>
      <p class="text-xs text-amber-400 mt-1">2 en mantenimiento</p>
    </article>

    <article class="bg-slate-900 border border-slate-800 rounded-xl p-4
                    hover:-translate-y-1 hover:shadow-2xl transition-all duration-200">
      <div class="flex items-start justify-between mb-3">
        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Colonias atendidas</p>
        <span class="w-7 h-7 rounded-lg bg-purple-950 flex items-center justify-center">
          <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </span>
      </div>
      <p class="font-heading text-3xl font-bold text-white">{{ $coloniasAtendidas ?? 37 }}</p>
      <p class="text-xs text-purple-400 mt-1">De {{ $totalColonias ?? 42 }} totales</p>
    </article>

  </div>

  {{-- ── Tabla de registros recientes ── --}}
  <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">

    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-800">
      <h2 class="font-heading text-xl font-bold text-white tracking-wide">Registros Recientes</h2>
      <a href="#"
         class="flex items-center gap-2 px-3 py-1.5 bg-brand-700 hover:bg-brand-600
                text-white text-xs font-semibold rounded-lg transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nuevo registro
      </a>
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
          @forelse($registros ?? [] as $registro)
            <tr class="border-b border-slate-800/50 odd:bg-white/[0.02] hover:bg-brand-500/[0.05] transition-colors">
              <td class="px-5 py-3 text-slate-300">
                {{ \Carbon\Carbon::parse($registro->fecha_orden)->format('d/m/Y') }}
              </td>
              <td class="px-5 py-3 text-brand-400 font-medium">{{ $registro->ruta }}</td>
              <td class="px-5 py-3 text-slate-300 hidden sm:table-cell">{{ $registro->chofer }}</td>
              <td class="px-5 py-3 text-slate-400 hidden md:table-cell capitalize">{{ $registro->turno }}</td>
              <td class="px-5 py-3 text-slate-400 hidden lg:table-cell">{{ $registro->km_recorridos }} km</td>
              <td class="px-5 py-3">
                @php
                  $badgeClasses = match($registro->estado) {
                    'completado' => 'bg-brand-950 text-brand-400',
                    'en_curso'   => 'bg-amber-950 text-amber-400',
                    'cancelado'  => 'bg-red-950   text-red-400',
                    default      => 'bg-slate-800  text-slate-400',
                  };
                @endphp
                <span class="px-2 py-0.5 {{ $badgeClasses }} text-xs rounded-full font-medium capitalize">
                  {{ ucfirst(str_replace('_', ' ', $registro->estado)) }}
                </span>
              </td>
            </tr>
          @empty
            {{-- Filas de ejemplo --}}
            @foreach([
              ['15/04/2026', 'R-01 Norte',    'J. García',    'Matutino',   '48 km', 'Completado', 'bg-brand-950 text-brand-400'],
              ['15/04/2026', 'R-03 Sur',      'M. López',     'Vespertino', '61 km', 'En curso',   'bg-amber-950 text-amber-400'],
              ['14/04/2026', 'R-07 Centro',   'A. Martínez',  'Matutino',   '37 km', 'Completado', 'bg-brand-950 text-brand-400'],
              ['14/04/2026', 'R-05 Oriente',  'R. Hernández', 'Nocturno',   '52 km', 'Cancelado',  'bg-red-950 text-red-400'],
              ['13/04/2026', 'R-02 Poniente', 'C. Ramírez',   'Matutino',   '44 km', 'Completado', 'bg-brand-950 text-brand-400'],
            ] as [$fecha, $ruta, $chofer, $turno, $km, $estado, $badge])
              <tr class="border-b border-slate-800/50 odd:bg-white/[0.02] hover:bg-brand-500/[0.05] transition-colors">
                <td class="px-5 py-3 text-slate-300">{{ $fecha }}</td>
                <td class="px-5 py-3 text-brand-400 font-medium">{{ $ruta }}</td>
                <td class="px-5 py-3 text-slate-300 hidden sm:table-cell">{{ $chofer }}</td>
                <td class="px-5 py-3 text-slate-400 hidden md:table-cell">{{ $turno }}</td>
                <td class="px-5 py-3 text-slate-400 hidden lg:table-cell">{{ $km }}</td>
                <td class="px-5 py-3">
                  <span class="px-2 py-0.5 {{ $badge }} text-xs rounded-full font-medium">
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