<?php

namespace Database\Factories;

use App\Models\Propiedad;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropiedadFactory extends Factory
{
    protected $model = Propiedad::class;

    private array $sectores = [
        'Barrio El Progreso', 'Sector La Unión', 'Ciudadela Los Pinos',
        'Barrio San José', 'Sector Nueva Esperanza', 'Urbanización El Paraíso',
        'Cooperativa La Victoria', 'Barrio Los Rosales', 'Sector El Mirador',
        'Ciudadela San Luis', 'Barrio La Colina', 'Sector Central',
    ];

    private array $tiposVia = ['Calle', 'Avenida', 'Pasaje', 'Callejón'];

    public function definition(): array
    {
        $tipoVia = $this->faker->randomElement($this->tiposVia);
        $numero  = $this->faker->numberBetween(1, 50);
        $casa    = $this->faker->numberBetween(100, 999);
        $sector  = $this->faker->randomElement($this->sectores);

        return [
            'socio_id'    => null, // se inyecta desde el seeder
            'descripcion' => $this->faker->randomElement([
                'Vivienda propia', 'Lote habitado', 'Casa con patio', 'Departamento', null,
            ]),
            'direccion'   => "$tipoVia $numero y $sector, Casa $casa",
            'estado'      => $this->faker->randomElement(['ACTIVA', 'ACTIVA', 'ACTIVA', 'INACTIVA', 'SUSPENDIDA']),
        ];
    }

    public function activa(): static
    {
        return $this->state(['estado' => 'ACTIVA']);
    }
}
