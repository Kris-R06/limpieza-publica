<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;
use App\Models\TipoTrabajador;

class TrabajadorController extends Controller
{
    public function index()
    {
        $trabajadores = Trabajador::with('tipoTrabajador')->get();
        return view('trabajadores.index', compact('trabajadores'));
    }

    public function create()
    {
        $tipos = TipoTrabajador::all();
        return view('trabajadores.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:trabajadores',
            'tipo' => 'required|exists:tipo_trabajadores,id',
        ], [
            'nombre.required' => 'El nombre del trabajador es obligatorio.',
            'nombre.unique' => 'Ya existe un trabajador con este nombre. Por favor, elige otro.',
            'tipo.required' => 'El tipo de trabajador es obligatorio.',
            'tipo.exists' => 'El tipo de trabajador seleccionado no es válido.',
        ]);

        $trabajador = new Trabajador();
        $trabajador->nombre = $request->input('nombre');
        $trabajador->tipo_trabajador_id = $request->input('tipo');
        $trabajador->save();

        return redirect()->route('trabajadores.index')->with('success', 'Trabajador creado exitosamente.');
    }

    public function edit($id)
    {
        $trabajador = Trabajador::findOrFail($id);
        $tipos = TipoTrabajador::all();
        return view('trabajadores.edit', compact('trabajador', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|unique:trabajadores,nombre,' . $id,
            'tipo' => 'required|exists:tipo_trabajadores,id',
        ], [
            'nombre.required' => 'El nombre del trabajador es obligatorio.',
            'nombre.unique' => 'Ya existe un trabajador con este nombre. Por favor, elige otro.',
            'tipo.required' => 'El tipo de trabajador es obligatorio.',
            'tipo.exists' => 'El tipo de trabajador seleccionado no es válido.',
        ]);

        $trabajador = Trabajador::findOrFail($id);
        $trabajador->nombre = $request->input('nombre');
        $trabajador->tipo_trabajador_id = $request->input('tipo');
        $trabajador->save();

        return redirect()->route('trabajadores.index')->with('success', 'Trabajador actualizado exitosamente.');
    }

    public function destroy($id)
    {
        try {
            $trabajador = Trabajador::findOrFail($id);
            $trabajador->delete();
            return redirect()->route('trabajadores.index')->with('success', 'Trabajador eliminado exitosamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('trabajadores.index')->with('error', 'No se puede eliminar el trabajador porque está relacionado con otros registros.');
        }
    }
}
