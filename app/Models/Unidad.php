<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TipoUnidad;

class Unidad extends Model
{
    protected $table = 'unidades';

    public function tipoUnidad()
    {
        return $this->belongsTo(TipoUnidad::class, 'tipo_unidad_id');
    }

}