@extends('layout.admin')
@section('content')
<div class="max-w-7xl mx-auto space-y-6 animate-fade-up">
    {{-- CARD DEL FORMULARIO --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        
        {{-- Header de la Card --}}
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 shadow-inner">
                <i class="ph ph-pencil-line text-2xl"></i>
            </div>
            <div>
                <h2 class="font-heading text-2xl font-bold text-slate-800 uppercase">Actualizar Colonia: {{ $colonia->nombre }}</h2>
            </div>
        </div>

        {{-- Cuerpo del Formulario --}}
        <form action="{{ route('colonias.update', $colonia->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-2">
                <label for="numero" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">
                    Número o Identificador de Ruta
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <i class="ph ph-hash-straight text-lg"></i>
                    </div>
                    <input type="text" 
                           name="nombre" 
                           id="nombre" 
                           value="{{ old('nombre', $colonia->nombre) }}"
                           class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-slate-700 font-medium focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition-all outline-none"
                           required>
                </div>
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1 font-medium italic leading-relaxed">{{ $message }}</p>
                @enderror
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <i class="ph ph-hash-straight text-lg"></i>
                    </div>
                    <input type="text" 
                           name="habitantes" 
                           id="habitantes" 
                           value="{{ old('habitantes', $colonia->habitantes) }}"
                           class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-slate-700 font-medium focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition-all outline-none"
                           required>
                </div>
                @error('habitantes')
                    <p class="text-red-500 text-sm mt-1 font-medium italic leading-relaxed">{{ $message }}</p>
                @enderror
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                        <i class="ph ph-hash-straight text-lg"></i>
                    </div>
                    <select name="id_ruta" id="id_ruta" class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-slate-700 font-medium focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition-all outline-none" required>
                        <option value="">Seleccionar Ruta</option>
                        @foreach($rutas as $ruta)
                            <option value="{{ $ruta->id }}">{{ $ruta->numero }}</option>
                        @endforeach
                    </select>
                </div>
                @error('id_ruta')
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
                        class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-lg shadow-blue-600/20 transition-all uppercase text-xs tracking-widest">
                    <i class="ph ph-arrow-clockwise text-lg"></i>
                    Actualizar Colonia
                </button>
            </div>
        </form>
    </div>

    {{-- AVISO DE AUDITORÍA --}}
    <div class="bg-amber-50/50 border border-amber-100 rounded-xl p-4 flex items-center gap-3">
        <i class="ph ph-warning-diamond text-amber-500 text-xl"></i>
        <p class="text-md text-amber-700 leading-relaxed text-center">
            <strong>Atención:</strong> Al cambiar el identificador de la ruta, todos los registros históricos asociados a este ID se actualizarán.
        </p>
    </div>

</div>
@endsection