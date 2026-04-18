@extends('layout.admin')
@section('content')
<div class="max-w-7xl mx-auto space-y-6 animate-fade-up">

    {{-- CARD DEL FORMULARIO --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        
        {{-- Header de la Card --}}
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-brand-100 flex items-center justify-center text-brand-600 shadow-inner">
                <i class="ph ph-map-trifold text-2xl"></i>
            </div>
            <div>
                <h2 class="font-heading text-2xl font-bold text-slate-800 uppercase">Crear Nueva Ruta</h2>
            </div>
        </div>

        {{-- Cuerpo del Formulario --}}
        <form action="{{ route('rutas.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            <div class="space-y-2">
                <label for="numero" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">
                    Número o Identificador de Ruta
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <i class="ph ph-hash-straight text-lg"></i>
                    </div>
                    <input type="text" 
                           name="numero" 
                           id="numero" 
                           placeholder="Ej. 01 o 02"
                           class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-slate-700 font-medium focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition-all outline-none"
                           required>
                </div>
                @error('numero')
                    <p class="text-red-500 text-sm mt-1 font-medium italic leading-relaxed">{{ $message }}</p>
                @enderror
            </div>

            {{-- FOOTER DE ACCIONES --}}
            <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                <a href="{{ route('rutas.index') }}" 
                   class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-400 hover:text-slate-600 hover:bg-gray-100 transition-all uppercase tracking-widest">
                    Cancelar
                </a>
                <button type="submit" 
                        class="flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-lg shadow-brand-600/20 transition-all uppercase text-xs tracking-widest">
                    <i class="ph ph-floppy-disk text-lg"></i>
                    Guardar Ruta
                </button>
            </div>
        </form>
    </div>

    {{-- TIP PARA EL USUARIO --}}
    <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-4 flex items-start gap-3">
        <i class="ph ph-info text-blue-500 text-xl mt-0.5"></i>
        <p class="text-xs text-blue-700 leading-relaxed">
            <strong>Dato de interés:</strong> Asegúrate de que el número de ruta no esté duplicado. El sistema de Mataranch organiza las rutas de forma alfanumérica para facilitar el monitoreo de los camiones.
        </p>
    </div>

</div>
@endsection