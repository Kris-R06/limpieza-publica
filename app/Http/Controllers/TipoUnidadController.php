<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoUnidad;

class TipoUnidadController extends Controller
{
    public function index()
    {
        $tipo_unidades = TipoUnidad::all();
        return view('tipo_unidades.index', compact('tipo_unidades'));
    }

    public function create()
    {
        return view('tipo_unidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $tipo_unidad = new TipoUnidad();
        $tipo_unidad->nombre = $request->input('nombre');
        $tipo_unidad->save();

        // TipoUnidad::create($request->all());

        return redirect()->route('tipo_unidades.index')
                         ->with('success', 'Tipo de unidad creado correctamente');
    }

    public function edit($id)
    {
        $tipo_unidad = TipoUnidad::findOrFail($id);
        return view('tipo_unidades.edit', compact('tipo_unidad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
        ]);

        $tipo_unidad = TipoUnidad::findOrFail($id);
        
        // $tipo_unidad->update($request->all());

        $tipo_unidad->nombre = $request->input('nombre');
        $tipo_unidad->save();

        return redirect()->route('tipo_unidades.index')->with('success', 'Actualizado correctamente');
    }

    public function destroy($id)
    {
        // TipoUnidad::destroy($id);
        $tipo_unidad = TipoUnidad::findOrFail($id);
        $tipo_unidad->delete();

        return redirect()->route('tipo_unidades.index')->with('success', 'Eliminado correctamente');
    }
}
