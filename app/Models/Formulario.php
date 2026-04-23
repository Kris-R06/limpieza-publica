<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Turno;
use App\Models\Unidad;
use App\Models\Ruta;
use App\Models\Trabajador;
use App\Models\User;
use App\Models\Colonia;
use App\Models\Folio;

class Formulario extends Model
{
    public $incrementing = false; // Le dices a Laravel: "Yo manejo los IDs"
    protected $table = 'formularios';
    use HasFactory;

    public function turno(){
        return $this->belongsTo(Turno::class, 'id_turno');
    }

    public function unidad(){
        return $this->belongsTo(Unidad::class, 'id_unidad');
    }

    public function ruta(){
        return $this->belongsTo(Ruta::class, 'id_ruta');
    }
    
    public function chofer()
    {
        return $this->belongsTo(Trabajador::class, 'id_chofer');
    }

    public function despachador()
    {
        return $this->belongsTo(Trabajador::class, 'id_despachador');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Según tu diagrama, Folios e id se conectan directo.
    public function folio()
    {
        return $this->belongsTo(Folio::class, 'id'); 
    }
    
    public function colonias()
    {
        // belongsToMany(Modelo a conectar, Tabla pivote, Llave local, Llave foránea)
        return $this->belongsToMany(
            Colonia::class,           // 1. El modelo con el que nos conectamos
            'formularios_colonias',   // 2. El nombre exacto de tu tabla pivote
            'id_formulario',          // 3. Como se llama la columna de este modelo en el pivote
            'id_colonia'              // 4. Como se llama la columna del otro modelo en el pivote
        )
        ->withPivot('porcentaje')     // MUY IMPORTANTE: Le decimos a Laravel que guarde el %
        ->withTimestamps();           // Para que llene created_at y updated_at en el pivote
    }
}