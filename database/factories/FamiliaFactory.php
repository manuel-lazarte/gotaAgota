<?php

namespace Database\Factories;

use App\Models\Familia;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamiliaFactory extends Factory
{
    protected $model = Familia::class;

    private array $apellidosFamilia = [
        'García', 'Rodríguez', 'López', 'Martínez', 'González', 'Pérez',
        'Sánchez', 'Ramírez', 'Torres', 'Herrera', 'Morales', 'Vargas',
    ];

    public function definition(): array
    {
        $apellido = $this->faker->randomElement($this->apellidosFamilia);

        return [
            'propiedad_id'    => null, // se inyecta desde el seeder
            'nombre'          => 'Familia '.$apellido,
            'num_integrantes' => $this->faker->numberBetween(1, 8),
        ];
    }
}
