<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tanque_comunitarios', function (Blueprint $table) {
            $table->id();
            $table->decimal('capacidad_total', 12, 2);
            $table->decimal('nivel_actual', 12, 2);
            $table->timestamp('fecha_registro');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanque_comunitarios');
    }
};
