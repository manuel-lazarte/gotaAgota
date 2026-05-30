<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cuota_aguas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('familia_id')->constrained('familias')->cascadeOnDelete();
            $table->decimal('litros_asignados', 10, 2);
            $table->string('periodo', 7); // formato: 2024-01
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cuota_aguas');
    }
};
