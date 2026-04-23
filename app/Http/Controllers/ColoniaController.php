<?php

namespace App\Http\Controllers;

use App\Models\Colonia;
use App\Models\Ruta;
use Illuminate\Http\Request;

class ColoniaController extends Controller
{
    public function index()
    {
        $colonias = Colonia::paginate(5);
        return view('colonias.index', compact('colonias'));
    }
    
    public function create()
    {
        $rutas = Ruta::all();
        return view('colonias.create', compact('rutas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'habitantes' => 'required|integer|min:1',
            'id_ruta' => 'required|exists:rutas,id',
        ], [
            'habitantes.min' => 'Los habitantes deben ser mayores a 0.',
            'id_ruta.exists' => 'La ruta seleccionada no existe.',
        ]
        );

        $colonia = new Colonia();
        $colonia->nombre = $request->nombre;
        $colonia->habitantes = $request->habitantes;
        $colonia->id_ruta = $request->id_ruta;
        $colonia->save();

        return redirect()->route('colonias.index')->with('success', 'Colonia creada exitosamente.');
    }

    public function edit($id)
    {
        $colonia = Colonia::findOrFail($id);
        $rutas = Ruta::all();
        return view('colonias.edit', compact('colonia', 'rutas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'habitantes' => 'required|integer|min:1',
            'id_ruta' => 'required|exists:rutas,id',
        ], [
            'habitantes.min' => 'Los habitantes deben ser mayores a 0.',
            'id_ruta.exists' => 'La ruta seleccionada no existe.',
        ]
        );

        $colonia = Colonia::findOrFail($id);
        $colonia->nombre = $request->nombre;
        $colonia->habitantes = $request->habitantes;
        $colonia->id_ruta = $request->id_ruta;
        $colonia->save();

        return redirect()->route('colonias.index')->with('success', 'Colonia actualizada exitosamente.');
    }

    public function destroy($id)
    {
        try {
             $colonia = Colonia::findOrFail($id);
             $colonia->delete();
             return redirect()->route('colonias.index')->with('success', 'Colonia eliminada exitosamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('colonias.index')->with('error', 'No se puede eliminar la colonia porque está relacionada con otros registros.');
        }
    }
}
