<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consumos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medidor_id')->constrained('medidors')->cascadeOnDelete();
            $table->decimal('lectura_anterior', 10, 2)->default(0);
            $table->decimal('lectura_actual', 10, 2);
            $table->decimal('consumo', 10, 2)->default(0);
            $table->date('fecha_lectura');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consumos');
    }
};
