<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formularios_colonias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_formulario')->constrained('formularios')->onDelete('cascade')->onUpdate('restrict');
            $table->foreignId('id_colonia')->constrained('colonias')->onDelete('cascade')->onUpdate('restrict');
            $table->decimal('porcentaje', 5, 2)->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularios_colonias');
    }
};
