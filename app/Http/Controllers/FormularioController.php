<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\Folio;
use App\Models\Ruta;
use App\Models\Colonia;
use App\Models\Turno;
use App\Models\TipoUnidad;
use App\Models\Unidad;
use App\Models\Trabajador;
use App\Models\User;

use ILLuminate\Support\Facades\DB;


class FormularioController extends Controller
{
    public function index(Request $request)
    {
        // 1. Cargamos las relaciones exactas que definimos en el modelo
        $query = Formulario::with(['unidad', 'ruta', 'chofer', 'despachador']);

        // 2. Filtros de Folio y Fechas (igual que antes)
        $query->when($request->filled('folio'), function ($q) use ($request) {
            $q->where('id', 'like', '%' . str_replace('#', '', $request->folio) . '%');
        });

        $query->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), function ($q) use ($request) {
            $q->whereBetween('fecha_orden', [$request->fecha_inicio, $request->fecha_fin]);
        });

        // 3. Filtros exactos de llaves foráneas
        $query->when($request->filled('id_unidad'), fn($q) => $q->where('id_unidad', $request->id_unidad));
        $query->when($request->filled('id_ruta'), fn($q) => $q->where('id_ruta', $request->id_ruta));
        
        // Filtros separados para los trabajadores según su rol en este formulario
        $query->when($request->filled('id_chofer'), fn($q) => $q->where('id_chofer', $request->id_chofer));
        $query->when($request->filled('id_despachador'), fn($q) => $q->where('id_despachador', $request->id_despachador));

        // 4. Paginación
        $formularios = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // 5. Catálogos para los selects
        $unidades = Unidad::all();
        $rutas = Ruta::all();
        $trabajadores = Trabajador::all(); 

        return view('formularios.index', compact('formularios', 'unidades', 'rutas', 'trabajadores'));
    }

    public function create()
    {
        $turnos = Turno::all();
        $rutas = Ruta::orderBy('numero')->get();
        $tipos_unidades = TipoUnidad::all();
        $unidades = Unidad::all();
        $choferes = Trabajador::where('tipo_trabajador_id', '1')->get(); 
        $despachadores = Trabajador::where('tipo_trabajador_id', '2')->get();

        return view('formularios.create', compact(
            'turnos', 
            'rutas', 
            'tipos_unidades',
            'unidades', 
            'choferes', 
            'despachadores'
        ));
    }
    
    public function store(Request $request)
    {
        // 1. EL ESCUDO (Validación de datos)
        // Nota: Usamos los nombres del HTML (kg_recolectados, km_salir, etc.)
        $request->validate([
            'fecha_orden'      => 'required|date',
            'id_turno'         => 'required|exists:turnos,id',
            'id_ruta'          => 'required|exists:rutas,id',
            'id_despachador'   => 'required|exists:trabajadores,id',
            'id_chofer'        => 'required|exists:trabajadores,id',
            'id_tipo_unidad'   => 'required|exists:tipo_unidades,id',
            'id_unidad'        => 'required|exists:unidades,id',
            'kg_recolectados'  => 'required|numeric|min:0',
            'puches'           => 'required|integer|min:0',
            'km_salir'         => 'required|numeric|min:0',
            'km_regresar'      => 'required|numeric|min:0',
            'km_recorridos'    => 'required|numeric|min:0',
            'diesel_inicial'   => 'required|numeric|min:0',
            'diesel_cargado'   => 'required|numeric|min:0',
            'diesel_final'     => 'required|numeric|min:0',
            'diesel_consumido' => 'required|numeric|min:0',
            'comentarios'      => 'nullable|string|max:1000',
            // Estadística
            'suma_porcentajes'  => 'nullable|numeric',
            'cantidad_colonias' => 'nullable|integer',
            'cobertura_total'   => 'nullable|string', 
            // El Arreglo de Colonias
            'colonias'              => 'required|array',
            'colonias.*.porcentaje' => 'required|numeric|min:0|max:100',
        ]);

        // 2. LIMPIEZA DE DATOS
        $cobertura_limpia = str_replace('%', '', $request->cobertura_total);

        // 3. LA TRANSACCIÓN (Todo o Nada)
        \DB::beginTransaction();

        try {
            // --- PASO A: GENERAR EL FOLIO OFICIAL ---
            // Insertamos y obtenemos el ID al instante para asegurar el 1 a 1
            $nuevoFolioId = \DB::table('folios')->insertGetId([
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // --- PASO B: CREAR EL FORMULARIO ---
            $formulario = new Formulario();
            
            // Asignamos el ID del folio como el ID del formulario (Lógica 1a1)
            $formulario->id = $nuevoFolioId; 
            
            // Datos generales
            $formulario->fecha_orden      = $request->fecha_orden;
            $formulario->fecha_captura    = now();
            $formulario->id_turno         = $request->id_turno;
            $formulario->id_ruta          = $request->id_ruta;
            $formulario->id_despachador   = $request->id_despachador;
            $formulario->id_chofer        = $request->id_chofer;
            $formulario->id_tipo_unidad   = $request->id_tipo_unidad;
            $formulario->id_unidad        = $request->id_unidad;
            $formulario->id_usuario       = auth()->id() ?? 1; // Fallback a 1 si no hay login
            $formulario->comentarios      = $request->comentarios;
            
            // Operación (Mapeo a columnas de BD)
            $formulario->cantidad_kg      = $request->kg_recolectados;
            $formulario->puches           = $request->puches;
            
            // Control de Unidad (Mapeo a columnas de BD)
            $formulario->km_salida        = $request->km_salir;
            $formulario->km_entrada       = $request->km_regresar;
            $formulario->km_total         = $request->km_recorridos;
            $formulario->diesel_inicial   = $request->diesel_inicial;
            $formulario->diesel_cargado   = $request->diesel_cargado;
            $formulario->diesel_final     = $request->diesel_final;
            $formulario->diesel_usado     = $request->diesel_consumido;
            
            // Estadística
            $formulario->year                 = now()->format('Y');
            $formulario->month                = now()->translatedFormat('F');
            $formulario->day                  = now()->format('d');
            $formulario->suma_porcentaje      = $request->suma_porcentajes ?? 0;
            $formulario->cant_colonias        = $request->cantidad_colonias ?? 0;
            $formulario->porcentaje_realizado = $cobertura_limpia ?? 0;
            
            // IMPORTANTE: Como estamos asignando el ID manualmente,
            // asegúrate de que en el Modelo Formulario tengas: public $incrementing = false;
            $formulario->save(); 

            // --- PASO C: RELACIÓN CON COLONIAS (Tabla Pivote) ---
            if ($request->has('colonias')) {
                $colonias_sync = [];
                foreach ($request->colonias as $colonia_id => $datos) {
                    $colonias_sync[$colonia_id] = ['porcentaje' => $datos['porcentaje']];
                }
                $formulario->colonias()->attach($colonias_sync);
            }

            // Si todo está bien, guardamos cambios permanentemente
            \DB::commit();
            
            $formulario = Formulario::with(['unidad', 'ruta', 'chofer'])->find($formulario->id);
            $this->notificarTelegram('CREADO', $formulario);
            return redirect()->route('formulario.index')
                            ->with('success', "¡Registro Guardado con éxito! Folio: #{$nuevoFolioId}");

        } catch (\Exception $e) {
            // Si algo falla, se cancela la creación del folio y del formulario
            \DB::rollBack();
            
            return redirect()->back()
                            ->withInput()
                            ->withErrors(['error' => 'Error de base de datos: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        // Eager loading para que la consulta sea ultra rápida
        $formulario = Formulario::with(['colonias',
                                        'unidad.tipo', // Carga el tipo de unidad a través de la relación en Unidad
                                        'chofer', 
                                        'despachador', 
                                        'turno', 
                                        'ruta', 
                                        'usuario'
                                ])->findOrFail($id);

        return view('formularios.show', compact('formulario'));
    }

    public function edit($id)
    {
        // Cargamos el formulario con su unidad
        $formulario = Formulario::with('unidad')->findOrFail($id);
        
        // Buscamos el ID del tipo a través de la unidad (ya que no está en la tabla formularios)
        // Asegúrate de que en tu tabla 'unidades' la columna se llame 'tipo_unidad_id'
        $tipoActualId = $formulario->unidad->tipo_unidad_id; 

        $turnos = Turno::all();
        $rutas = Ruta::all();
        $despachadores = Trabajador::where('tipo_trabajador_id', 2)->get();
        $choferes = Trabajador::where('tipo_trabajador_id', 1)->get();
        $tipos_unidades = TipoUnidad::all();
        
        // Cargamos solo las unidades que pertenecen a ese tipo para que el select no esté vacío
        $unidades = \App\Models\Unidad::where('tipo_unidad_id', $tipoActualId)->get();

        return view('formularios.edit', compact(
            'formulario', 'turnos', 'rutas', 'despachadores', 
            'choferes', 'tipos_unidades', 'unidades', 'tipoActualId'
        ));
    }

    // --- PROCESAR LA ACTUALIZACIÓN ---
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_orden' => 'required|date',
            // ... (usa las mismas validaciones que en el store)
        ]);

        \DB::beginTransaction();
        try {
            $formulario = Formulario::findOrFail($id);
            
            // Mapeo de datos (Igual que el store, pero sin generar nuevo Folio)
            $formulario->fecha_orden    = $request->fecha_orden;
            $formulario->id_turno       = $request->id_turno;
            $formulario->id_ruta        = $request->id_ruta;
            $formulario->id_chofer      = $request->id_chofer;
            $formulario->id_unidad      = $request->id_unidad;
            $formulario->cantidad_kg    = $request->kg_recolectados;
            $formulario->km_entrada     = $request->km_regresar;
            $formulario->km_total       = $request->km_recorridos;
            $formulario->diesel_usado   = $request->diesel_consumido;
            $formulario->comentarios    = $request->comentarios;

            // Limpieza de porcentaje
            $cobertura = str_replace('%', '', $request->cobertura_total);
            $formulario->porcentaje_realizado = $cobertura;

            $formulario->save();

            // ACTUALIZACIÓN DE COLONIAS (SYNC es la clave aquí)
            if ($request->has('colonias')) {
                $colonias_sync = [];
                foreach ($request->colonias as $col_id => $datos) {
                    $colonias_sync[$col_id] = ['porcentaje' => $datos['porcentaje']];
                }
                $formulario->colonias()->sync($colonias_sync);
            }

            \DB::commit();
            return redirect()->route('formulario.index')->with('success', 'Registro actualizado correctamente.');

        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // --- ELIMINAR EL REGISTRO ---
    public function destroy($id)
    {
        try {
            $formulario = Formulario::findOrFail($id);
            $this->notificarTelegram('ELIMINADO', $formulario);
            // Desacoplamos las colonias primero para no dejar basura en la tabla pivote
            $formulario->colonias()->detach();
            $formulario->delete();

            return redirect()->route('formulario.index')->with('success', 'Registro eliminado del sistema.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'No se pudo eliminar: ' . $e->getMessage()]);
        }
    }

    // API TELEGRAM
    private function notificarTelegram($accion, $formulario)
    {
        $telegramToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        //Usuario
        $usuario = auth()->user() ? auth()->user()->name . ' ' . auth()->user()->lastname : 'Sistema Automático';
        
        //Lo que pasó
        $icono = $accion === 'CREADO' ? '✅' : '🗑️';
        
        //Información
        $mensaje = "{$icono} *ALERTA SUDO-TRASH* \n\n";
        $mensaje .= "Se ha *{$accion}* un registsro en la base de datos:\n\n";
        $mensaje .= "📄 *Folio:* #{$formulario->id}\n";
        $mensaje .= "📅 *Fecha de Captura:* {$formulario->fecha_captura}\n";
        $mensaje .= "---------------------------\n";
        $mensaje .= "🚛 *Unidad:* {$formulario->unidad->nombre}\n";
        $mensaje .= "🛣️ *Ruta:* {$formulario->ruta->numero}\n";
        $mensaje .= "👨‍✈️ *Chofer:* {$formulario->chofer->nombre}\n";
        $mensaje .= "📉 *Cobertura:* {$formulario->porcentaje_realizado}%\n";
        $mensaje .= "---------------------------\n";
        $mensaje .= "👤 *Responsable:* {$usuario}";
        if ($accion === 'ELIMINADO') {
            $mensaje .= "\n🕒 *Fecha y Hora (Sistema):* " . now()->format('d/m/Y H:i:s');
        }

        //Mandar Mensaje
        try {
            \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                'chat_id' => $chatId,
                'text'    => $mensaje,
                'parse_mode' => 'Markdown'
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Fallo Telegram: " . $e->getMessage());
        }
    }

    //pdf
    public function generarPDF($id)
    {
        // Carga todas las relaciones para que no den error de 'null' en el PDF
        $formulario = Formulario::with(['unidad.tipo', 'ruta', 'chofer', 'despachador', 'turno', 'usuario', 'colonias'])->findOrFail($id);
        
        // Llamamos a la vista que acabamos de crear
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('formularios.pdf', compact('formulario'));
        
        // El método stream abre el PDF en el navegador, download lo descarga directo
        return $pdf->stream('Reporte_Folio_'.$formulario->id.'.pdf');
    }
}