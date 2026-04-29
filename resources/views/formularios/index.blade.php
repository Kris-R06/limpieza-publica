@extends('layout.admin')

@section('content')
<div class="space-y-6 animate-fade-up">
    
    {{-- ENCABEZADO DE PÁGINA --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-heading text-3xl sm:text-4xl font-extrabold text-brand-850 tracking-wide">Formularios</h1>
            <p class="text-sm text-slate-500">Historial de recolección y formularios de Sudo-Trash.</p>
        </div>
        <div>
            <button type="button" id="btn-toggle-filtros" 
                class="inline-flex items-center justify-center gap-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-6 rounded-xl shadow-sm transition-all uppercase text-xs tracking-widest">
                <i class="ph ph-funnel text-lg"></i>
                Filtros
            </button>
            <a href="{{ route('formulario.create') }}" 
            class="inline-flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-brand-600/20 transition-all uppercase text-xs tracking-widest">
                <i class="ph ph-plus-circle text-lg"></i>
                Nuevo Registro
            </a>
        </div>
    </div>

    <div id="panel-filtros" class="hidden mt-6 bg-white border border-slate-200 rounded-2xl shadow-sm p-6 transition-all duration-300">
        <form action="{{ route('formulario.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                
                {{-- Folio --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Folio</label>
                    <input type="text" name="folio" placeholder="#0003" value="{{ request('folio') }}"
                        class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring focus:ring-brand-500/20 text-sm">
                </div>

                {{-- Rango de Fechas --}}
                <div class="lg:col-span-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Rango de Fecha (Orden)</label>
                    <div class="flex items-center gap-2">
                        <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}"
                            class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring focus:ring-brand-500/20 text-sm">
                        <span class="text-slate-400 text-sm font-medium">a</span>
                        <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}"
                            class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring focus:ring-brand-500/20 text-sm">
                    </div>
                </div>

                {{-- Unidad --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Unidad</label>
                    <select name="unidad_id" class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring focus:ring-brand-500/20 text-sm">
                        <option value="">Todas</option>
                        @foreach($unidades as $unidad)
                            <option value="{{ $unidad->id }}" {{ request('unidad_id') == $unidad->id ? 'selected' : '' }}>{{ $unidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Ruta --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Ruta</label>
                    <select name="id_ruta" class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring focus:ring-brand-500/20 text-sm">
                        <option value="">Todas</option>
                        @foreach($rutas as $ruta)
                            <option value="{{ $ruta->id }}" {{ request('id_ruta') == $ruta->id ? 'selected' : '' }}>Ruta {{ $ruta->numero }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Chofer --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Chofer</label>
                    <select name="id_chofer" class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring focus:ring-brand-500/20 text-sm">
                        <option value="">Todos</option>
                        @foreach($trabajadores as $trabajador)
                            <option value="{{ $trabajador->id }}" {{ request('id_chofer') == $trabajador->id ? 'selected' : '' }}>
                                {{ $trabajador->nombre }} {{ $trabajador->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Despachador --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Despachador</label>
                    <select name="id_despachador" class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring focus:ring-brand-500/20 text-sm">
                        <option value="">Todos</option>
                        @foreach($trabajadores as $trabajador)
                            <option value="{{ $trabajador->id }}" {{ request('id_despachador') == $trabajador->id ? 'selected' : '' }}>
                                {{ $trabajador->nombre }} {{ $trabajador->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botones de Acción --}}
                <div class="flex items-end gap-3 h-full">
                    <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-2.5 px-4 rounded-lg transition-colors text-sm">
                        Aplicar
                    </button>
                    <a href="{{ route('formulario.index') }}" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-2.5 px-4 rounded-lg transition-colors text-sm text-center">
                        Limpiar
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- CARD PRINCIPAL CON TABLA --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">Folio</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">Fecha Orden</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">Unidad</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">Ruta</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">Chofer</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">Despachador</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($formularios as $formulario)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        
                        {{-- ID / FOLIO --}}
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-500">#{{ str_pad($formulario->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        
                        {{-- FECHA DE ORDEN --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="ph ph-calendar-blank text-brand-500 text-lg"></i>
                                {{-- Si usas Carbon, esto formatea la fecha a DD/MM/YYYY --}}
                                <span class="text-sm font-bold text-slate-700 tracking-wide">{{ \Carbon\Carbon::parse($formulario->fecha_orden)->format('d/m/Y') }}</span>
                            </div>
                        </td>

                        {{-- UNIDAD --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="ph ph-bus text-brand-500 text-lg"></i>
                                <span class="text-sm font-bold text-slate-700 uppercase">{{ $formulario->unidad->numero }}</span>
                            </div>
                        </td>

                        {{-- RUTA --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="ph ph-map-pin-line text-brand-500 text-lg"></i>
                                <span class="text-sm font-bold text-slate-700 uppercase">{{ $formulario->ruta->numero }}</span>
                            </div>
                        </td>

                        {{-- CHOFER--}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="ph ph-steering-wheel text-brand-500 text-lg"></i>
                                <span class="text-sm font-bold text-slate-700 uppercase">{{ $formulario->chofer->nombre }}</span>
                            </div>
                        </td>

                        {{-- DESPACHADOR --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="ph ph-pencil text-brand-500 text-lg"></i>
                                <span class="text-sm font-bold text-slate-700 uppercase">{{ $formulario->despachador->nombre }}</span> 
                            </div>
                        </td>

                        {{-- ACCIONES --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('formulario.show', $formulario->id) }}" 
                                    class="p-2 rounded-lg text-green-600 hover:bg-green-50 transition-all"
                                    title="Ver Detalle">
                                    <i class="ph ph-eye text-lg"></i>
                                </a>
                                <a href="{{ route('formulario.edit', $formulario->id) }}" 
                                   class="p-2 rounded-lg text-blue-600 hover:bg-blue-50 transition-all" 
                                   title="Editar Formulario">
                                    <i class="ph ph-pencil-line text-xl"></i>
                                </a>
                                <form action="{{ route('formulario.destroy', $formulario->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('¿Estás seguro de eliminar este folio? Esta acción es irreversible.')"
                                            class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all">
                                        <i class="ph ph-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        {{-- Ajustamos el colspan a 6 porque ahora tenemos 6 columnas exactas --}}
                        <td colspan="6" class="px-6 py-12 text-center border-b-0">
                            <div class="flex flex-col items-center gap-3">
                                <i class="ph ph-file-dashed text-5xl text-slate-200"></i>
                                <p class="text-slate-400 text-sm">No se encontraron formularios operativos registrados.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN CORREGIDA --}}
        @if(method_exists($formularios, 'links') && $formularios->hasPages())
        <div class="px-6 py-4 bg-gray-50/30 border-t border-gray-100">
            {{ $formularios->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnFiltros = document.getElementById('btn-toggle-filtros');
        const panelFiltros = document.getElementById('panel-filtros');

        // Si ya hay filtros activos en la URL, mantenemos el panel abierto
        if (window.location.search.length > 0) {
            panelFiltros.classList.remove('hidden');
        }

        btnFiltros.addEventListener('click', function () {
            panelFiltros.classList.toggle('hidden');
        });
    });
</script>
@endsection