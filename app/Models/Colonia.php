<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ruta;

class Colonia extends Model
{
    protected $table = 'colonias';

    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'id_ruta');
    }
}
