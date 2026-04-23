<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            //fechas
            $table->date('fecha_orden');
            $table->dateTime('fecha_captura');
            //relaciones
            $table->foreignId('id_turno')->constrained('turnos')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('id_tipo_unidad')->constrained('tipo_unidades')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('id_unidad')->constrained('unidades')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('id_ruta')->constrained('rutas')->onDelete('restrict')->onUpdate('restrict');
            //chofer y despachador
            $table->foreignId('id_chofer')->constrained('trabajadores')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('id_despachador')->constrained('trabajadores')->onDelete('restrict')->onUpdate('restrict');
            //usuario que captura el formulario
            $table->foreignId('id_usuario')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
            //Datos
            $table->decimal('cantidad_kg', 8, 2)->default(0);
            $table->integer('puches')->default(0);
            $table->text('comentarios')->nullable();
            //kilometraje
            $table->decimal('km_salida', 10, 2);
            $table->decimal('km_entrada', 10, 2);
            $table->decimal('km_total', 10, 2)->default(0);
            //diesel
            $table->decimal('diesel_inicial', 8, 2);
            $table->decimal('diesel_final', 8, 2);
            $table->decimal('diesel_cargado', 8, 2)->default(0);
            $table->decimal('diesel_usado', 8, 2)->default(0);
            //fechas separadas
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');
            $table->unsignedTinyInteger('day');
            // Métricas de Colonias
            $table->integer('cant_colonias')->default(0);
            $table->decimal('suma_porcentaje', 8, 2)->default(0);
            $table->decimal('porcentaje_realizado', 5, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularios');
    }
};
