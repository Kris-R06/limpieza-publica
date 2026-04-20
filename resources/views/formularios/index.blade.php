@extends('layout.admin')

@section('content')
<div class="space-y-6 animate-fade-up">
    
    {{-- ENCABEZADO DE PÁGINA --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-heading text-3xl sm:text-4xl font-extrabold text-brand-850 tracking-wide">Formularios</h1>
            <p class="text-sm text-slate-500">Historial de recolección y formularios de Sudo-Trash.</p>
        </div>
        
        <a href="{{ route('formulario.create') }}" 
           class="inline-flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-brand-600/20 transition-all uppercase text-xs tracking-widest">
            <i class="ph ph-plus-circle text-lg"></i>
            Nuevo Registro
        </a>
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
@endsection