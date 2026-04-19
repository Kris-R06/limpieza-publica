<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TipoTrabajador;

class Trabajador extends Model
{
    protected $table = 'trabajadores';

    public function tipoTrabajador()
    {
        return $this->belongsTo(TipoTrabajador::class, 'tipo_trabajador_id');
    }
}
