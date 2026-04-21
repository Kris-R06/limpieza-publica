@extends('layout.admin')

@section('content')
<div class="space-y-6 animate-fade-up">
    
    {{-- ENCABEZADO DE PÁGINA --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-heading text-3xl sm:text-4xl font-extrabold text-brand-850 tracking-wide">Control de Folios</h1>
            <p class="text-sm text-slate-500">Auditoría de folios generados automáticamente por Sudo-Trash.</p>
        </div>
        
        {{-- En lugar de un botón de crear, ponemos un badge informativo --}}
        <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-700 py-2 px-4 rounded-xl shadow-sm">
            <i class="ph ph-info text-xl"></i>
            <span class="text-xs font-bold uppercase tracking-widest">Generación Automática</span>
        </div>
    </div>

    {{-- CARD PRINCIPAL CON TABLA --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100 w-32">Folio ID</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">Fecha de Generación</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-gray-100">Registro Asociado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($folios as $folio)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        
                        {{-- FOLIO ID --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="ph ph-ticket text-brand-600 text-xl"></i>
                                {{-- Rellenamos con ceros para que se vea como un folio real (ej. #00001) --}}
                                <span class="text-base font-black text-slate-700 tracking-wider">#{{ str_pad($folio->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </td>
                        
                        {{-- FECHA DE CREACIÓN --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="ph ph-clock text-slate-400 text-lg"></i>
                                <span class="text-sm font-semibold text-slate-600">
                                    {{ $folio->created_at->format('d/m/Y h:i A') }}
                                </span>
                            </div>
                        </td>

                        {{-- FORMULARIO ASOCIADO --}}
                        <td class="px-6 py-4">
                        @if($folio->formulario)
                            <a href="{{ route('formulario.edit', $folio->formulario->id) }}" 
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline uppercase tracking-wide">
                                <i class="ph ph-link"></i>
                                Formulario #{{ str_pad($folio->formulario->id, 3, '0', STR_PAD_LEFT) }}
                            </a>
                        @else
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wide italic">
                                Sin enlace
                            </span>
                        @endif
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center border-b-0">
                            <div class="flex flex-col items-center gap-3">
                                <i class="ph ph-ticket text-5xl text-slate-200"></i>
                                <p class="text-slate-400 text-sm">Aún no se han generado folios en el sistema.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        @if(method_exists($folios, 'links') && $folios->hasPages())
        <div class="px-6 py-4 bg-gray-50/30 border-t border-gray-100">
            {{ $folios->links() }}
        </div>
        @endif
    </div>
</div>
@endsection