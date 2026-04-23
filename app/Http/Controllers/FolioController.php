<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folio;

class FolioController extends Controller
{
    public function index()
    {
        $folios = Folio::with('formulario')->get(); // <--- 'with' es la clave
        return view('folios.index', compact('folios'));
    }

    public function show(Folio $folio)
    {
        $folio->load('formulario.ruta', 'formulario.unidad');
        return view('folios.show', compact('folio'));
    }
}
