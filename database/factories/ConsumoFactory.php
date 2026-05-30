<?php

namespace Database\Factories;

use App\Models\Consumo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsumoFactory extends Factory
{
    protected $model = Consumo::class;

    public function definition(): array
    {
        // Se inyecta desde el seeder con lectura anterior correcta
        $lecturaAnterior = $this->faker->randomFloat(2, 0, 5000);
        $incremento      = $this->faker->randomFloat(2, 5, 80); // consumo mensual realista en m3
        $lecturaActual   = round($lecturaAnterior + $incremento, 2);

        return [
            'medidor_id'       => null,
            'lectura_anterior' => $lecturaAnterior,
            'lectura_actual'   => $lecturaActual,
            'consumo'          => round($lecturaActual - $lecturaAnterior, 2),
            'fecha_lectura'    => $this->faker->dateTimeBetween('-12 months', 'now')->format('Y-m-d'),
        ];
    }
}
