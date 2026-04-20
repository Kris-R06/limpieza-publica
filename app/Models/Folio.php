<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    protected $table = 'folios';

    public function formulario()
    {
        return $this->hasOne(Formulario::class, 'id', 'id');
    }
}