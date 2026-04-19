<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;
use App\Models\TipoUnidad;

class UnidadController extends Controller
{
    //
    public function index()
    {
        $unidades = Unidad::with('tipoUnidad')->paginate(10);
        return view('unidades.index', compact('unidades'));
    }

    public function create()
    {
        $tipos = TipoUnidad::all();
        return view('unidades.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:unidades',
            'tipo' => 'required|exists:tipo_unidades,id',
            'numero' => 'required|unique:unidades',
        ], [
            'nombre.required' => 'El nombre de la unidad es obligatorio.',
            'nombre.unique' => 'Ya existe una unidad con este nombre. Por favor, elige otro.',
            'numero.required' => 'El número de unidad es obligatorio.',
            'numero.unique' => 'Ya existe una unidad con este número. Por favor, elige otro.',
            'tipo.required' => 'El tipo de unidad es obligatorio.',
            'tipo.exists' => 'El tipo de unidad seleccionado no es válido.',
        ]);

        $unidad = new Unidad();
        $unidad->nombre = $request->input('nombre');
        $unidad->numero = $request->input('numero');
        $unidad->tipo_unidad_id = $request->input('tipo');
        $unidad->save();

        return redirect()->route('unidades.index')->with('success', 'Unidad creada exitosamente.');
    }

    public function edit($id)
    {
        $unidad = Unidad::findOrFail($id);
        $tipos = TipoUnidad::all();
        return view('unidades.edit', compact('unidad', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|unique:unidades,nombre,' . $id,
            'tipo' => 'required|exists:tipo_unidades,id',
            'numero' => 'required|unique:unidades,numero,' . $id,
        ], [
            'nombre.required' => 'El nombre de la unidad es obligatorio.',
            'nombre.unique' => 'Ya existe una unidad con este nombre. Por favor, elige otro.',
            'tipo.required' => 'El tipo de unidad es obligatorio.',
            'tipo.exists' => 'El tipo de unidad seleccionado no es válido.',
            'numero.required' => 'El número de unidad es obligatorio.',
            'numero.unique' => 'Ya existe una unidad con este número. Por favor, elige otro.',
        ]);

        $unidad = Unidad::findOrFail($id);
        $unidad->nombre = $request->input('nombre');
        $unidad->tipo_unidad_id = $request->input('tipo');
        $unidad->numero = $request->input('numero');
        $unidad->save();

        return redirect()->route('unidades.index')->with('success', 'Unidad actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $unidad = Unidad::findOrFail($id);
        $unidad->delete();

        return redirect()->route('unidades.index')->with('success', 'Unidad eliminada exitosamente.');
    }
}