<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;

class RutaController extends Controller
{
    public function index()
    {
        $rutas = Ruta::latest('id')->paginate(10);
        return view('rutas.index', compact('rutas'));
    }

    public function create()
    {
        return view('rutas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:rutas',
        ], [
            'numero.required' => 'El número de ruta es obligatorio.',
            'numero.unique' => 'Ya existe una ruta con este número. Por favor, elige otro.',
        ]);

        $ruta = new Ruta();
        $ruta->numero = $request->input('numero');
        $ruta->save();

        return redirect()->route('rutas.index')->with('success', 'Ruta creada exitosamente.');
    }

    public function edit($id)
    {
        $ruta = Ruta::findOrFail($id);
        return view('rutas.edit', compact('ruta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'numero' => 'required|unique:rutas,numero,' . $id,
        ], [
            'numero.required' => 'El número de ruta es obligatorio.',
            'numero.unique' => 'Ya existe una ruta con este número. Por favor, elige otro.',
        ]);

        $ruta = Ruta::findOrFail($id);
        $ruta->numero = $request->input('numero');
        $ruta->save();

        return redirect()->route('rutas.index')->with('success', 'Ruta actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);
        $ruta->delete();

        return redirect()->route('rutas.index')->with('success', 'Ruta eliminada exitosamente.');
    }
}
