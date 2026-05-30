<?php

namespace Database\Factories;

use App\Models\TelefonoSocio;
use Illuminate\Database\Eloquent\Factories\Factory;

class TelefonoSocioFactory extends Factory
{
    protected $model = TelefonoSocio::class;

    // Prefijos de operadoras ecuatorianas
    private array $prefijos = ['09', '098', '099', '097', '096', '095'];

    public function definition(): array
    {
        $prefijo = $this->faker->randomElement($this->prefijos);
        $resto   = $this->faker->numerify(str_repeat('#', 10 - strlen($prefijo)));

        return [
            'socio_id'    => null, // se inyecta desde el seeder
            'numero'      => $prefijo.$resto,
            'es_principal' => false,
        ];
    }

    public function principal(): static
    {
        return $this->state(['es_principal' => true]);
    }
}
