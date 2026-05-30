<?php

namespace Database\Factories;

use App\Models\Medidor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedidorFactory extends Factory
{
    protected $model = Medidor::class;

    public function definition(): array
    {
        $año   = $this->faker->numberBetween(2015, 2024);
        $mes   = str_pad($this->faker->numberBetween(1, 12), 2, '0', STR_PAD_LEFT);
        $serie = strtoupper($this->faker->lexify('??'))
                .'-'.$this->faker->numerify('####')
                .'-'.$this->faker->numerify('###');

        return [
            'propiedad_id'      => null, // se inyecta desde el seeder
            'numero_serie'      => $serie,
            'fecha_instalacion' => "$año-$mes-01",
            'activo'            => $this->faker->boolean(92),
        ];
    }

    public function activo(): static
    {
        return $this->state(['activo' => true]);
    }
}
