{{-- resources/views/formulario.blade.php --}}
@extends('layout.admin')
@section('content')
{{-- ══════════════════════════════════════════════
     FORMULARIO DE REGISTRO
═══════════════════════════════════════════════ --}}

{{-- Macro: input de texto/número reutilizable --}}
{{-- Clases base para todos los inputs --}}
@php
  $input  = 'w-full rounded-lg px-3 py-2 text-sm bg-slate-800 border text-slate-200 placeholder:text-slate-500 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-colors duration-200';
  $inputRO = 'w-full rounded-lg px-3 py-2 text-sm bg-slate-800/50 border border-slate-700 text-brand-400 cursor-not-allowed focus:outline-none';
@endphp

<section class="animate-fade-up">

  {{-- Título --}}
  <div class="mb-7">
    <h1 class="font-heading text-3xl sm:text-4xl font-extrabold text-white tracking-wide">
      Registro de Actividad
    </h1>
    <p class="text-slate-400 text-sm mt-1 flex items-center gap-2">
      Actividades de Limpieza Pública — Complete todos los campos requeridos
      <span class="inline-flex items-center gap-1 text-xs text-red-400">
        <span class="w-2 h-2 rounded-full bg-red-500"></span> Campo requerido
      </span>
    </p>
  </div>

  {{-- Errores de validación --}}
  @if($errors->any())
    <div class="mb-6 bg-red-950 border border-red-800 rounded-xl px-5 py-4">
      <p class="text-sm font-semibold text-red-400 mb-2">Por favor corrija los siguientes errores:</p>
      <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
          <li class="text-xs text-red-300">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Éxito --}}
  @if(session('success'))
    <div class="mb-6 bg-brand-950 border border-brand-700 rounded-xl px-5 py-4 flex items-center gap-3">
      <svg class="w-5 h-5 text-brand-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      <p class="text-sm text-brand-300">{{ session('success') }}</p>
    </div>
  @endif

  <form id="main-form" action="{{ route('formulario.store') }}" method="POST" novalidate>
    @csrf

    {{-- ═══════════════════════════════
         BLOQUE 1 · DATOS GENERALES
    ════════════════════════════════ --}}
    <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5 mb-6">
      <legend class="font-heading text-base font-bold text-brand-400 tracking-wide px-2 uppercase">
        Datos Generales
      </legend>

      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Fecha de orden --}}
        <div>
          <label for="fecha_orden"
                 class="flex items-center gap-1.5 text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-red-500 flex-shrink-0"></span>
            Fecha de orden
          </label>
          <input type="date" id="fecha_orden" name="fecha_orden" required
                 value="{{ old('fecha_orden') }}"
                 class="{{ $input }} {{ $errors->has('fecha_orden') ? 'border-red-500' : 'border-slate-700' }}" />
          @error('fecha_orden')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
          @enderror
        </div>

        {{-- Fecha y hora de captura --}}
        <div>
          <label for="fecha_captura"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Fecha y hora de captura
          </label>
          <input type="datetime-local" id="fecha_captura" name="fecha_captura"
                 value="{{ old('fecha_captura') }}"
                 class="{{ $input }} border-slate-700" />
        </div>

        {{-- Turno --}}
        <div>
          <label for="turno"
                 class="flex items-center gap-1.5 text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-red-500 flex-shrink-0"></span>
            Turno
          </label>
          <div class="relative">
            <select id="turno" name="turno" required
                    class="appearance-none {{ $input }} pr-9
                           {{ $errors->has('turno') ? 'border-red-500' : 'border-slate-700' }} cursor-pointer">
              <option value="" disabled {{ old('turno') ? '' : 'selected' }}>Seleccionar…</option>
              <option value="matutino"   {{ old('turno') === 'matutino'   ? 'selected' : '' }}>Matutino</option>
              <option value="vespertino" {{ old('turno') === 'vespertino' ? 'selected' : '' }}>Vespertino</option>
              <option value="nocturno"   {{ old('turno') === 'nocturno'   ? 'selected' : '' }}>Nocturno</option>
            </select>
            <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center">
              <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/>
              </svg>
            </span>
          </div>
          @error('turno') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Ruta --}}
        <div>
          <label for="ruta"
                 class="flex items-center gap-1.5 text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-red-500 flex-shrink-0"></span>
            Ruta
          </label>
          <div class="relative">
            <select id="ruta" name="ruta" required
                    class="appearance-none {{ $input }} pr-9
                           {{ $errors->has('ruta') ? 'border-red-500' : 'border-slate-700' }} cursor-pointer">
              <option value="" disabled {{ old('ruta') ? '' : 'selected' }}>Tabla…</option>
              @foreach($rutas ?? [] as $ruta)
                <option value="{{ $ruta->id }}" {{ old('ruta') == $ruta->id ? 'selected' : '' }}>
                  {{ $ruta->nombre }}
                </option>
              @endforeach
            </select>
            <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center">
              <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/>
              </svg>
            </span>
          </div>
          @error('ruta') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

      </div>
    </fieldset>

    {{-- ═══════════════════════════════
         BLOQUE 2 · PERSONAL Y UNIDAD
    ════════════════════════════════ --}}
    <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5 mb-6">
      <legend class="font-heading text-base font-bold text-brand-400 tracking-wide px-2 uppercase">
        Personal y Unidad
      </legend>

      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Despachador --}}
        <div>
          <label for="despachador"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Despachador
          </label>
          <div class="relative">
            <select id="despachador" name="despachador"
                    class="appearance-none {{ $input }} border-slate-700 pr-9 cursor-pointer">
              <option value="" disabled selected>Tabla…</option>
              @foreach($despachadores ?? [] as $d)
                <option value="{{ $d->id }}" {{ old('despachador') == $d->id ? 'selected' : '' }}>
                  {{ $d->nombre }}
                </option>
              @endforeach
            </select>
            <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center">
              <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/>
              </svg>
            </span>
          </div>
        </div>

        {{-- Chofer --}}
        <div>
          <label for="chofer"
                 class="flex items-center gap-1.5 text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-red-500 flex-shrink-0"></span>
            Chofer
          </label>
          <div class="relative">
            <select id="chofer" name="chofer" required
                    class="appearance-none {{ $input }} pr-9
                           {{ $errors->has('chofer') ? 'border-red-500' : 'border-slate-700' }} cursor-pointer">
              <option value="" disabled selected>Tabla…</option>
              @foreach($choferes ?? [] as $c)
                <option value="{{ $c->id }}" {{ old('chofer') == $c->id ? 'selected' : '' }}>
                  {{ $c->nombre }}
                </option>
              @endforeach
            </select>
            <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center">
              <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/>
              </svg>
            </span>
          </div>
          @error('chofer') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Tipo unidad --}}
        <div>
          <label for="tipo_unidad"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Tipo Unidad
          </label>
          <div class="relative">
            <select id="tipo_unidad" name="tipo_unidad"
                    class="appearance-none {{ $input }} border-slate-700 pr-9 cursor-pointer">
              <option value="" disabled selected>Tabla…</option>
              <option value="compactador" {{ old('tipo_unidad') === 'compactador' ? 'selected' : '' }}>Compactador</option>
              <option value="volteo"      {{ old('tipo_unidad') === 'volteo'      ? 'selected' : '' }}>Volteo</option>
              <option value="pickup"      {{ old('tipo_unidad') === 'pickup'      ? 'selected' : '' }}>Pick-up</option>
            </select>
            <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center">
              <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/>
              </svg>
            </span>
          </div>
        </div>

        {{-- Unidades --}}
        <div>
          <label for="unidades"
                 class="flex items-center gap-1.5 text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-red-500 flex-shrink-0"></span>
            Unidades
          </label>
          <div class="relative">
            <select id="unidades" name="unidades" required
                    class="appearance-none {{ $input }} pr-9
                           {{ $errors->has('unidades') ? 'border-red-500' : 'border-slate-700' }} cursor-pointer">
              <option value="" disabled selected>Tabla…</option>
              @foreach($unidades ?? [] as $u)
                <option value="{{ $u->id }}" {{ old('unidades') == $u->id ? 'selected' : '' }}>
                  {{ $u->nombre }}
                </option>
              @endforeach
            </select>
            <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center">
              <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/>
              </svg>
            </span>
          </div>
          @error('unidades') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

      </div>
    </fieldset>

    {{-- ═══════════════════════════════
         BLOQUE 3 · DATOS DE OPERACIÓN
    ════════════════════════════════ --}}
    <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5 mb-6">
      <legend class="font-heading text-base font-bold text-brand-400 tracking-wide px-2 uppercase">
        Datos de Operación
      </legend>

      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <div>
          <label for="cantidad"
                 class="flex items-center gap-1.5 text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-red-500 flex-shrink-0"></span>
            Cantidad
          </label>
          <input type="number" id="cantidad" name="cantidad" min="0" required
                 value="{{ old('cantidad') }}" placeholder="0"
                 class="{{ $input }} {{ $errors->has('cantidad') ? 'border-red-500' : 'border-slate-700' }}" />
          @error('cantidad') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="puches"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Puches
          </label>
          <input type="number" id="puches" name="puches" min="0"
                 value="{{ old('puches') }}" placeholder="0"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="km_salir"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Km al salir
          </label>
          <input type="number" id="km_salir" name="km_salir" min="0"
                 value="{{ old('km_salir') }}" placeholder="0"
                 oninput="calcKm()"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="km_regresar"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Km al regresar
          </label>
          <input type="number" id="km_regresar" name="km_regresar" min="0"
                 value="{{ old('km_regresar') }}" placeholder="0"
                 oninput="calcKm()"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="km_recorridos"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Km recorridos
            <span class="text-brand-600 normal-case font-normal">(automático)</span>
          </label>
          <input type="number" id="km_recorridos" name="km_recorridos" readonly
                 value="{{ old('km_recorridos') }}" placeholder="—"
                 class="{{ $inputRO }}" />
        </div>

      </div>
    </fieldset>

    {{-- ═══════════════════════════════
         BLOQUE 4 · CONTROL DE DIESEL
    ════════════════════════════════ --}}
    <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5 mb-6">
      <legend class="font-heading text-base font-bold text-brand-400 tracking-wide px-2 uppercase">
        Control de Diesel
      </legend>

      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <div>
          <label for="diesel_inicial"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Diesel inicial (L)
          </label>
          <input type="number" id="diesel_inicial" name="diesel_inicial" min="0"
                 value="{{ old('diesel_inicial') }}" placeholder="0"
                 oninput="calcDiesel()"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="diesel_final"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Diesel final (L)
          </label>
          <input type="number" id="diesel_final" name="diesel_final" min="0"
                 value="{{ old('diesel_final') }}" placeholder="0"
                 oninput="calcDiesel()"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="diesel_cargado"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Diesel cargado (L)
          </label>
          <input type="number" id="diesel_cargado" name="diesel_cargado" min="0"
                 value="{{ old('diesel_cargado') }}" placeholder="0"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="diesel_unidad"
                 class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Diesel en unidad
            <span class="text-brand-600 normal-case font-normal">(automático)</span>
          </label>
          <input type="number" id="diesel_unidad" name="diesel_unidad" readonly
                 value="{{ old('diesel_unidad') }}" placeholder="—"
                 class="{{ $inputRO }}" />
        </div>

      </div>
    </fieldset>

    {{-- ═══════════════════════════════
         BLOQUE 5 · COBERTURA
    ════════════════════════════════ --}}
    <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5 mb-6">
      <legend class="font-heading text-base font-bold text-brand-400 tracking-wide px-2 uppercase">
        Estadística de Cobertura
      </legend>

      <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5">

        <div>
          <label for="anio" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Año</label>
          <input type="number" id="anio" name="anio" min="2000" max="2099"
                 value="{{ old('anio') }}" placeholder="{{ date('Y') }}"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="mes" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Mes</label>
          <div class="relative">
            <select id="mes" name="mes"
                    class="appearance-none {{ $input }} border-slate-700 pr-9 cursor-pointer">
              <option value="" disabled selected>—</option>
              @foreach(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'] as $m)
                <option value="{{ $m }}" {{ old('mes') === $m ? 'selected' : '' }}>{{ $m }}</option>
              @endforeach
            </select>
            <span class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center">
              <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/>
              </svg>
            </span>
          </div>
        </div>

        <div>
          <label for="dia" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Día</label>
          <input type="number" id="dia" name="dia" min="1" max="31"
                 value="{{ old('dia') }}" placeholder="1"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="suma" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Suma</label>
          <input type="number" id="suma" name="suma" min="0"
                 value="{{ old('suma') }}" placeholder="0"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="cant_colonias" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            Cant. Colonias
          </label>
          <input type="number" id="cant_colonias" name="cant_colonias" min="0"
                 value="{{ old('cant_colonias') }}" placeholder="0"
                 class="{{ $input }} border-slate-700" />
        </div>

        <div>
          <label for="pct_atendido" class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">
            % Atendido
          </label>
          <input type="number" id="pct_atendido" name="pct_atendido" min="0" max="100"
                 value="{{ old('pct_atendido') }}" placeholder="0"
                 class="{{ $input }} border-slate-700" />
        </div>

      </div>
    </fieldset>

    {{-- ═══════════════════════════════
         BLOQUE 6 · COLONIAS DE LA RUTA
    ════════════════════════════════ --}}
    <fieldset class="bg-slate-900 border border-slate-800 rounded-xl p-5 mb-6">
      <legend class="font-heading text-base font-bold text-brand-400 tracking-wide px-2 uppercase">
        Colonias de la Ruta
      </legend>

      <p class="mt-2 mb-4 text-xs text-slate-500 italic">
        * El ID mostrado no corresponde al ID de la base de datos.
      </p>

      <div class="overflow-x-auto rounded-lg border border-slate-800 mb-4">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-slate-800 bg-slate-800/50">
              <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-12">#</th>
              <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nombre</th>
              <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-20">%</th>
              <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Habitantes</th>
              <th class="px-4 py-2.5 w-10"></th>
            </tr>
          </thead>
          <tbody id="colonies-body"></tbody>
        </table>
      </div>

      <button type="button" onclick="addColonyRow()"
              class="flex items-center gap-2 px-3 py-1.5
                     border border-slate-700 hover:border-brand-600
                     text-slate-400 hover:text-brand-400
                     text-xs rounded-lg transition-colors duration-150">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Agregar colonia
      </button>
    </fieldset>

    {{-- ── Botones de acción ── --}}
    <div class="flex flex-col sm:flex-row items-center justify-end gap-3 pt-2 pb-4">
      <button type="button" onclick="resetForm()"
              class="w-full sm:w-auto px-6 py-2.5
                     border border-slate-700 hover:border-slate-500
                     text-slate-400 hover:text-white
                     text-sm font-semibold rounded-lg transition-colors duration-150">
        Limpiar formulario
      </button>
      <button type="submit"
              class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-2.5
                     bg-brand-700 hover:bg-brand-600 active:bg-brand-800
                     text-white text-sm font-semibold rounded-lg
                     transition-colors duration-150 shadow-lg shadow-brand-900/40">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        GUARDAR
      </button>
    </div>

  </form>
</section>

<script src="{{ asset('js/formulario.js') }}"></script>

@endsection