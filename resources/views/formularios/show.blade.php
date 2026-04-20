@extends('layout.admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 pb-12 animate-fade-up">
    
    {{-- ENCABEZADO REFINADO --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Folio #{{ $formulario->id }}</h1>
            <p class="text-md text-slate-400 uppercase font-black tracking-widest mt-1">
                Resumen Operativo • Captura: {{ $formulario->fecha_captura }}
            </p>
        </div>
        <a href="{{ route('formulario.index') }}" class="px-5 py-2 bg-gray-50 text-brand-600 rounded-xl font-bold uppercase text-[10px] tracking-widest hover:bg-brand-600 hover:text-white transition-all flex items-center gap-2">
            <i class="ph ph-arrow-left text-lg"></i> Volver
        </a>
    </div>

    {{-- FILA 1: TIEMPO | KILOMETRAJE | OPERACIÓN --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- TARJETA A: CRONOLOGÍA --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col h-full">
            <h3 class="text-[14px] font-black text-brand-600 uppercase tracking-widest mb-6 flex items-center gap-2 border-b border-brand-50 pb-2">
                <i class="ph ph-calendar-blank"></i> Control de Tiempo
            </h3>
            <div class="space-y-4 flex-1">
                <div class="flex justify-between items-center">
                    <span class="text-[12px] text-slate-400 font-bold uppercase">Fecha Orden</span>
                    <span class="text-base font-bold text-slate-700">{{ $formulario->fecha_orden }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[12px] text-slate-400 font-bold uppercase">Turno</span>
                    <span class="text-base font-bold text-slate-700">{{ $formulario->turno->horario }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[12px] text-slate-400 font-bold uppercase">Capturista</span>
                    <span class="text-base font-bold text-slate-700">
                        {{ $formulario->usuario->name ?? 'N/A' }} {{ $formulario->usuario->lastname ?? '' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- TARJETA B: KILOMETRAJE --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col h-full">
            <h3 class="text-[14px] font-black text-brand-600 uppercase tracking-widest mb-6 border-b border-gray-50 pb-2">Kilometraje</h3>
            <div class="space-y-4 flex-1">
                <div class="flex justify-between items-center text-slate-500">
                    <span class="text-[12px] font-bold uppercase">Km Salida / Regreso</span>
                    <span class="text-sm font-bold">{{ $formulario->km_salida }} km / {{ $formulario->km_entrada }} km</span>
                </div>
                <div class="flex justify-between items-center pt-2">
                    <span class="text-[12px] font-black text-slate-800 uppercase">Total Recorrido</span>
                    <span class="text-3xl font-black text-brand-600">{{ $formulario->km_total }} <span class="text-xs">KM</span></span>
                </div>
            </div>
        </div>

        {{-- TARJETA C: CARGA --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col h-full">
            <h3 class="text-[14px] font-black text-brand-600 uppercase tracking-widest mb-6 border-b border-gray-50 pb-2">Recolección</h3>
            <div class="space-y-4 flex-1">
                <div class="flex justify-between items-center">
                    <span class="text-[12px] text-slate-400 font-bold uppercase">Kg Recolectados</span>
                    <span class="text-3xl font-black text-slate-800">{{ $formulario->cantidad_kg }} <span class="text-sm">kg</span></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[12px] text-slate-400 font-bold uppercase">Puches</span>
                    <span class="text-3xl font-black text-slate-800">{{ $formulario->puches }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- FILA 2: EQUIPO | COMBUSTIBLE | EFICIENCIA --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- ASIGNACIÓN --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col h-full">
            <h3 class="text-[14px] font-black text-brand-600 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-brand-50 pb-2">
                <i class="ph ph-users text-lg"></i> Asignación
            </h3>
            <div class="space-y-2 flex-1 text-sm">
                <p class="flex justify-between"><span class="text-[12px] text-slate-400 font-bold uppercase">Tipo:</span> <span class="font-bold text-slate-700">{{ $formulario->unidad->tipo->nombre }}</span></p>
                <p class="flex justify-between"><span class="text-[12px] text-slate-400 font-bold uppercase">Unidad:</span> <span class="font-bold text-slate-700">#{{ $formulario->unidad->numero }} - {{ $formulario->unidad->nombre }}</span></p>
                <p class="flex justify-between"><span class="text-[12px] text-slate-400 font-bold uppercase">Ruta:</span> <span class="font-bold text-slate-700">Ruta {{ $formulario->ruta->numero }}</span></p>
                <p class="flex justify-between"><span class="text-[12px] text-slate-400 font-bold uppercase">Chofer:</span> <span class="font-bold text-slate-700">{{ $formulario->chofer->nombre }}</span></p>
                <p class="flex justify-between"><span class="text-[12px] text-slate-400 font-bold uppercase">Despachador:</span> <span class="font-bold text-slate-700">{{ $formulario->despachador->nombre }}</span></p>
            </div>
        </div>

        {{-- COMBUSTIBLE --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col h-full">
            <h3 class="text-[14px] font-black text-brand-600 uppercase tracking-widest mb-4 border-b border-gray-50 pb-2">Diésel (Lts)</h3>
            <div class="text-center flex-1 flex flex-col justify-center">
                <p class="text-4xl font-black text-slate-800">{{ $formulario->diesel_usado }}</p>
                <p class="text-[14px] text-slate-400 font-bold uppercase">Consumo Total</p>
            </div>
            <div class="flex justify-around pt-4 border-t border-gray-50 text-center">
                <div><p class="text-base font-bold text-slate-700">{{ $formulario->diesel_inicial }}</p><p class="text-[12px] text-slate-400 uppercase">Inicial</p></div>
                <div><p class="text-base font-bold text-slate-700">{{ $formulario->diesel_cargado }}</p><p class="text-[12px] text-slate-400 uppercase">Cargado</p></div>
                <div><p class="text-base font-bold text-slate-700">{{ $formulario->diesel_final }}</p><p class="text-[12px] text-slate-400 uppercase">Final</p></div>
            </div>
        </div>

        {{-- EFICIENCIA --}}
        <div class="bg-brand-50/50 p-6 rounded-2xl border border-brand-100 flex flex-col h-full justify-center text-center">
            <h3 class="text-[14px] font-black text-brand-600 uppercase tracking-widest mb-2">Cobertura</h3>
            <p class="text-5xl font-black text-brand-700">{{ $formulario->porcentaje_realizado }}%</p>
            <div class="mt-4 pt-3 border-t border-brand-100/50 text-[14px] font-bold text-brand-800 uppercase">
                {{ $formulario->cant_colonias }} colonias | Suma: {{ $formulario->suma_porcentaje }}%
            </div>
        </div>
    </div>

    {{-- TABLA DE COLONIAS --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 bg-gray-50/50 border-b border-gray-100">
            <h3 class="text-[14px] font-black text-brand-600 uppercase tracking-widest">Colonias Atendidas</h3>
        </div>
        <table class="w-full text-left">
            <thead>
                <tr class="text-[14px] font-black text-slate-400 uppercase border-b border-gray-50 bg-gray-50/20">
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3 text-center">Habitantes</th>
                    <th class="px-6 py-3 text-right">Porcentaje</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @foreach($formulario->colonias as $colonia)
                <tr class="hover:bg-brand-50/20 transition-colors">
                    <td class="px-6 py-3 font-bold text-slate-700 uppercase">{{ $colonia->nombre }}</td>
                    <td class="px-6 py-3 text-center text-slate-500">{{ $colonia->habitantes ?? 0 }}</td>
                    <td class="px-6 py-3 text-right font-black text-brand-600">{{ $colonia->pivot->porcentaje }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- OBSERVACIONES --}}
    <div class="bg-amber-50/50 p-6 rounded-2xl border border-amber-100 shadow-sm">
        <h3 class="text-[10px] font-black text-amber-700 uppercase tracking-widest mb-2">Observaciones</h3>
        <p class="text-base text-slate-700 italic font-medium">
            "{{ $formulario->comentarios ?? 'Sin observaciones.' }}"
        </p>
    </div>

</div>
@endsection