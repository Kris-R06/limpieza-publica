@extends('layout.admin')
@section('content')
<div class="space-y-6 animate-fade-up">
    
    {{-- ENCABEZADO DE PÁGINA --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-heading text-3xl font-bold text-slate-900 uppercase tracking-tight">Lista de Rutas</h1>
            <p class="text-sm text-slate-500">Administración de trayectos de limpieza para el municipio de Mataranch.</p>
        </div>
        
        <a href="{{ route('rutas.create') }}" 
           class="inline-flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-brand-600/20 transition-all uppercase text-xs tracking-widest">
            <i class="ph ph-plus-circle text-lg"></i>
            Agregar Nueva Ruta
        </a>
    </div>

    {{-- CARD PRINCIPAL CON TABLA --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">ID</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">Número de Ruta</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($rutas as $ruta)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-slate-400">#{{ str_pad($ruta->id, 3, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="ph ph-path text-brand-600"></i>
                                <span class="text-sm font-bold text-brand-700 tracking-wide uppercase">Ruta {{ $ruta->numero }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center gap-2">
                                {{-- Botón Editar --}}
                                <a href="{{ route('rutas.edit', $ruta->id) }}" 
                                   class="p-2 rounded-lg text-blue-600 hover:bg-blue-50 transition-all" 
                                   title="Editar Ruta">
                                    <i class="ph ph-pencil-line text-xl"></i>
                                </a>

                                {{-- Botón Eliminar --}}
                                <form action="{{ route('rutas.destroy', $ruta->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('¿Estás seguro de eliminar esta ruta en Mataranch?')"
                                            class="p-2 rounded-lg text-red-500 hover:bg-red-50 transition-all"
                                            title="Eliminar Ruta">
                                        <i class="ph ph-trash text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <i class="ph ph-detective text-5xl text-slate-200"></i>
                                <p class="text-slate-400 text-sm">No se encontraron rutas registradas.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN (Opcional, si usas ->paginate() en el controlador) --}}
        @if(method_exists($rutas, 'links'))
        <div class="px-6 py-4 bg-gray-50/30 border-t border-gray-100">
            {{ $rutas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection