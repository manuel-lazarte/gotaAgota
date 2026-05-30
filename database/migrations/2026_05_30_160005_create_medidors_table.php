<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medidors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedads')->cascadeOnDelete();
            $table->string('numero_serie')->unique();
            $table->date('fecha_instalacion');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medidors');
    }
};
