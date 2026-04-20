@extends('layout.admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 animate-fade-up pb-12">
    
    {{-- ENCABEZADO --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-heading text-3xl font-bold text-slate-900 uppercase tracking-tight">Registro de Actividad</h1>
            <p class="text-sm text-slate-500 mt-1">Bitácora operativa de Sudo-Trash. <span class="text-red-500 font-medium">* Campos obligatorios</span></p>
        </div>
    </div>

    {{-- ALERTAS DE ERROR --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
            <i class="ph ph-warning-circle text-red-500 text-xl mt-0.5"></i>
            <div>
                <p class="text-sm font-bold text-red-800">Hay errores en el formulario:</p>
                <ul class="list-disc list-inside text-xs text-red-600 mt-1">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form id="main-form" action="{{ route('formulario.store') }}" method="POST" class="space-y-6" novalidate>
        @csrf

    {{-- BLOQUE 1: INFORMACIÓN OPERATIVA --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
            <i class="ph ph-clipboard-text text-xl text-brand-600"></i>
            <h2 class="font-heading text-sm font-bold text-slate-800 uppercase tracking-widest">Información del Registro</h2>
        </div>
        
        <div class="p-6 space-y-6">
            
            {{-- FILA 1: GENERALES (3 campos iguales) --}}
            <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
                <div class="md:col-span-2 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Fecha de Orden <span class="text-red-500">*</span></label>
                    <input type="date" name="fecha_orden" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-brand-500/20">
                </div>
                <div class="md:col-span-2 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Fecha de Captura</label>
                    <input type="datetime-local" value="{{ now()->format('Y-m-d\TH:i') }}" readonly 
                        class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-brand-600 font-bold text-sm cursor-not-allowed outline-none">
                </div>
                <div class="md:col-span-2 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Turno <span class="text-red-500">*</span></label>
                    <select name="id_turno" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none cursor-pointer">
                        <option value="" disabled selected>Seleccionar...</option>
                        @foreach($turnos as $turno) <option value="{{ $turno->id }}">{{ $turno->horario }}</option> @endforeach
                    </select>
                </div>

                {{-- FILA 2: PERSONAL (3 campos iguales) --}}
                <div class="md:col-span-2 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Ruta Operativa <span class="text-red-500">*</span></label>
                    <select id="ruta_selector" name="id_ruta" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none cursor-pointer">
                        <option value="" disabled selected>Elegir Ruta...</option>
                        @foreach($rutas as $ruta) <option value="{{ $ruta->id }}">{{ $ruta->numero }}</option> @endforeach
                    </select>
                </div>
                <div class="md:col-span-2 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Despachador <span class="text-red-500">*</span></label>
                    <select name="id_despachador" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none cursor-pointer">
                        <option value="" disabled selected>Seleccionar...</option>
                        @foreach($despachadores as $d) <option value="{{ $d->id }}">{{ $d->nombre }}</option> @endforeach
                    </select>
                </div>
                <div class="md:col-span-2 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Chofer <span class="text-red-500">*</span></label>
                    <select name="id_chofer" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none cursor-pointer">
                        <option value="" disabled selected>Seleccionar...</option>
                        @foreach($choferes as $c) <option value="{{ $c->id }}">{{ $c->nombre }}</option> @endforeach
                    </select>
                </div>

                {{-- FILA 3: UNIDADES (50/50 -> 1.5 + 1.5) --}}
                <div class="md:col-span-3 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Tipo de Unidad <span class="text-red-500">*</span></label>
                    <select id="tipo_unidad_selector" name="id_tipo_unidad" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none cursor-pointer">
                        <option value="" disabled selected>Seleccionar tipo...</option>
                        @foreach($tipos_unidades as $tipo) <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option> @endforeach
                    </select>
                </div>
                <div class="md:col-span-3 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Unidad <span class="text-red-500">*</span></label>
                    <select id="unidad_selector" name="id_unidad" disabled class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-sm outline-none cursor-not-allowed">
                        <option value="" disabled selected>Primero elige un tipo...</option>
                    </select>
                </div>

                {{-- FILA 4: DATOS DE OPERACIÓN (50/50 -> 1.5 + 1.5) --}}
                <div class="md:col-span-3 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Kg Recolectados</label>
                    <div class="relative">
                        <input type="number" name="kg_recolectados" placeholder="0.00 kg" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-500/20 outline-none">
                    </div>
                </div>
                <div class="md:col-span-3 space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Puches Realizados</label>
                    <input type="number" name="puches" placeholder="Cantidad de puches" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-brand-500/20">
                </div>

                {{-- FILA 5: ESTADÍSTICA BLOQUEADA (3 campos iguales) --}}
                <div class="md:col-span-2 space-y-1">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Año</label>
                    <input type="number" name="anio" value="{{ now()->format('Y') }}" readonly 
                        class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-slate-500 text-sm cursor-not-allowed outline-none">
                </div>
                <div class="md:col-span-2 space-y-1">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Mes</label>
                    {{-- Usamos un input texto en lugar de select para que el readonly sea real --}}
                    <input type="text" name="mes" value="{{ now()->translatedFormat('F') }}" readonly 
                        class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-slate-500 text-sm cursor-not-allowed outline-none capitalize">
                </div>
                <div class="md:col-span-2 space-y-1">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Día</label>
                    <input type="number" name="dia" value="{{ now()->format('d') }}" readonly 
                        class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-slate-500 text-sm cursor-not-allowed outline-none">
                </div>
            </div>
        </div>
    </div> {{-- Aquí cierra la tarjeta de Datos Generales --}}

    {{-- BLOQUE 2: PORCENTAJES (ESTADÍSTICA) --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
            <i class="ph ph-chart-bar text-xl text-brand-600"></i>
            <h2 class="font-heading text-sm font-bold text-slate-800 uppercase tracking-widest">Operaciones de Porcentajes</h2>
        </div>
        
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Suma de %</label>
                    {{-- ID agregado: calc_suma --}}
                    <input type="text" id="calc_suma" name="suma_porcentajes" value="0" readonly 
                        class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-slate-500 font-bold text-sm cursor-not-allowed outline-none">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Cantidad de Colonias</label>
                    {{-- ID agregado: calc_cantidad --}}
                    <input type="text" id="calc_cantidad" name="cantidad_colonias" value="0" readonly 
                        class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-slate-500 font-bold text-sm cursor-not-allowed outline-none">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">% de Cobertura Total</label>
                    {{-- ID agregado: calc_cobertura --}}
                    <input type="text" id="calc_cobertura" name="cobertura_total" value="0%" readonly 
                        class="w-full px-4 py-2.5 bg-brand-50 border border-brand-200 rounded-xl text-brand-700 font-black text-sm cursor-not-allowed outline-none">
                </div>
            </div>
        </div>
    </div>

    {{-- BLOQUE 3: COLONIAS DINÁMICAS --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="ph ph-map-pin-line text-xl text-brand-600"></i>
                <h2 class="font-heading text-sm font-bold text-slate-800 uppercase tracking-widest">Cobertura de Colonias</h2>
            </div>
            <span id="loader_colonias" class="text-xs text-brand-600 font-bold animate-pulse hidden">Cargando colonias...</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/30">
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-gray-100 w-16">ID</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-gray-100">Nombre de la Colonia</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-gray-100">Habitantes</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-gray-100 w-32">% Atendido</th>
                    </tr>
                </thead>
                <tbody id="tabla_colonias_body" class="divide-y divide-gray-50">
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-400 text-sm italic">
                            Selecciona una ruta arriba para cargar sus colonias automáticamente.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- BLOQUE 4: CONTROL DE UNIDAD (KM Y DIÉSEL) --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
            <i class="ph ph-gauge text-xl text-brand-600"></i>
            <h2 class="font-heading text-sm font-bold text-slate-800 uppercase tracking-widest">Control de Unidad</h2>
        </div>
        
        <div class="p-6 space-y-8">
            
            {{-- SECCIÓN KILOMETRAJE (3 campos) --}}
            <div>
                <h3 class="text-[10px] font-bold text-slate-400 mb-4 uppercase tracking-[0.2em]">Registro de Kilometraje</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Km al Salir</label>
                        <input type="number" id="km_salir" name="km_salir" placeholder="0" min="0"
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-brand-500/20">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Km al Regresar</label>
                        <input type="number" id="km_regresar" name="km_regresar" placeholder="0" min="0"
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-brand-500/20">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Km Recorridos</label>
                        <input type="text" id="km_recorridos" name="km_recorridos" value="0" readonly
                               class="w-full px-4 py-2.5 bg-brand-50 border border-brand-200 rounded-xl text-brand-700 font-black text-sm cursor-not-allowed outline-none">
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- SECCIÓN DIÉSEL (4 campos) --}}
            <div>
                <h3 class="text-[10px] font-bold text-slate-400 mb-4 uppercase tracking-[0.2em]">Control de Combustible</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Diésel Inicial (L)</label>
                        <input type="number" id="diesel_inicial" name="diesel_inicial" placeholder="0.0" step="0.1" min="0"
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-brand-500/20">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Diésel Cargado (L)</label>
                        <input type="number" id="diesel_cargado" name="diesel_cargado" placeholder="0.0" step="0.1" min="0"
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-brand-500/20">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Diésel Final (L)</label>
                        <input type="number" id="diesel_final" name="diesel_final" placeholder="0.0" step="0.1" min="0"
                               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-brand-500/20">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Diésel Consumido</label>
                        <div class="relative">
                            <input type="text" id="diesel_consumido" name="diesel_consumido" value="0.0" readonly
                                   class="w-full px-4 py-2.5 bg-brand-50 border border-brand-200 rounded-xl text-brand-700 font-black text-sm cursor-not-allowed outline-none">
                            <span class="absolute inset-y-0 right-4 flex items-center text-brand-600 font-bold text-xs">Lts</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- BLOQUE 5: OBSERVACIONES Y COMENTARIOS --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
            <i class="ph ph-chat-centered-text text-xl text-brand-600"></i>
            <h2 class="font-heading text-sm font-bold text-slate-800 uppercase tracking-widest">Comentarios de la Jornada</h2>
        </div>
        <div class="p-6">
            <textarea name="comentarios" rows="4" 
                      placeholder="Escribe aquí cualquier observación relevante sobre la ruta, el personal o la unidad..."
                      class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-brand-500/20 transition-all resize-none"></textarea>
        </div>
    </div>

    {{-- BOTONERA (FUERA DE LAS TARJETAS) --}}
    <div class="flex items-center justify-end gap-4 pt-4">
        <a href="{{ route('formulario.index') }}" 
            class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-400 hover:text-slate-600 hover:bg-gray-100 transition-all uppercase tracking-widest">
            Cancelar
        </a>
        <button type="submit" class="flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-bold py-2.5 px-8 rounded-xl shadow-lg shadow-brand-600/20 transition-all uppercase text-xs tracking-widest">
            <i class="ph ph-floppy-disk text-lg"></i>
            Guardar Registro
        </button>
    </div>

    </form>
</div>

<script>
    const API_COLONIAS_URL = "{{ url('/api/rutas') }}"; 
</script>
<script src="{{ asset('js/formulario.js') }}"></script>
@endsection