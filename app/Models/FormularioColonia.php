<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormularioColonia extends Model
{
    protected $table = 'formularios_colonias';

    public function formulario()
    {
        return $this->belongsTo(Formulario::class, 'id_formulario');
    }

    public function colonia()
    {
        return $this->belongsTo(Colonia::class, 'id_colonia');
    }
}
