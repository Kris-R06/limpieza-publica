<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;

class TurnoController extends Controller
{
    public function index()
    {
        $turnos = Turno::all();
        return view('turnos.index', compact('turnos'));
    }

    public function create()
    {
        return view('turnos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'horario' => 'required|string|max:50'
        ]);

        $turno = new Turno();
        $turno->horario = $request->input('horario');
        $turno->save();

        // Turno::create($request->all());

        return redirect()->route('turnos.index')
                         ->with('success', 'Turno creado correctamente');
    }

    public function edit($id)
    {
        $turno = Turno::findOrFail($id);
        return view('turnos.edit', compact('turno'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'horario' => 'required|string|max:255'
        ], [
            'horario.required' => 'El horario es obligatorio.',
        ]);

        $turno = Turno::findOrFail($id);
        
        // $turno->update($request->all());

        $turno->horario = $request->input('horario');
        $turno->save();

        return redirect()->route('turnos.index')->with('success', 'Turno actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            $turno = Turno::findOrFail($id);
            $turno->delete();
            return redirect()->route('turnos.index')->with('success', 'Turno eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('turnos.index')->with('error', 'No se puede eliminar el turno porque está relacionado con otros registros.');
        }
    }
}
