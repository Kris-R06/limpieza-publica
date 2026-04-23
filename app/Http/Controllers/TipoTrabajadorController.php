<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoTrabajador;

class TipoTrabajadorController extends Controller
{
    public function index()
    {
        $tipo_trabajadores = TipoTrabajador::all();
        return view('tipo_trabajadores.index', compact('tipo_trabajadores'));
    }

    public function create()
    {
        return view('tipo_trabajadores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $tipo_trabajador = new TipoTrabajador();
        $tipo_trabajador->nombre = $request->input('nombre');
        $tipo_trabajador->save();

        // TipoTrabajador::create($request->all());

        return redirect()->route('tipo_trabajadores.index')
                         ->with('success', 'Tipo de trabajador creado correctamente');
    }

    public function edit($id)
    {
        $tipo_trabajador = TipoTrabajador::findOrFail($id);
        return view('tipo_trabajadores.edit', compact('tipo_trabajador'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
        ]);

        $tipo_trabajador = TipoTrabajador::findOrFail($id);
        
        // $tipo_trabajador->update($request->all());

        $tipo_trabajador->nombre = $request->input('nombre');
        $tipo_trabajador->save();

        return redirect()->route('tipo_trabajadores.index')->with('success', 'Actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            $tipo_trabajador = TipoTrabajador::findOrFail($id);
            $tipo_trabajador->delete();
            return redirect()->route('tipo_trabajadores.index')->with('success', 'Tipo de trabajador eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('tipo_trabajadores.index')->with('error', 'No se puede eliminar el tipo de trabajador porque está relacionado con otros registros.');
        }
    }
}
