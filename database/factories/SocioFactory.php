<?php

namespace Database\Factories;

use App\Models\Socio;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocioFactory extends Factory
{
    protected $model = Socio::class;

    // Nombres y apellidos hispanos comunes en Ecuador
    private array $nombresH = [
        'Carlos', 'Luis', 'José', 'Jorge', 'Marco', 'Diego', 'Roberto', 'Andrés',
        'Fernando', 'Eduardo', 'Miguel', 'Patricio', 'Ramiro', 'Víctor', 'Hugo',
    ];
    private array $nombresM = [
        'María', 'Ana', 'Carmen', 'Rosa', 'Lucia', 'Gabriela', 'Patricia', 'Verónica',
        'Sandra', 'Mariana', 'Lorena', 'Alexandra', 'Daniela', 'Cristina', 'Isabel',
    ];
    private array $apellidos = [
        'García', 'Rodríguez', 'López', 'Martínez', 'González', 'Pérez', 'Sánchez',
        'Ramírez', 'Torres', 'Flores', 'Herrera', 'Morales', 'Ortiz', 'Vargas',
        'Castillo', 'Ramos', 'Mendoza', 'Guerrero', 'Reyes', 'Ávila', 'Cárdenas',
    ];

    public function definition(): array
    {
        $esMujer  = $this->faker->boolean(40);
        $nombre   = $esMujer
            ? $this->faker->randomElement($this->nombresM)
            : $this->faker->randomElement($this->nombresH);
        $apellido = $this->faker->randomElement($this->apellidos).' '.$this->faker->randomElement($this->apellidos);

        // Cédula ecuatoriana simulada: 10 dígitos, primeros 2 = provincia (01-24)
        $provincia = str_pad(rand(1, 24), 2, '0', STR_PAD_LEFT);
        $cedula    = $provincia.fake()->numerify('########');

        return [
            'nombre'   => $nombre,
            'apellido' => $apellido,
            'cedula'   => $cedula,
            'email'    => strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $nombre))
                         .'.'.strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', explode(' ', $apellido)[0]))
                         .'@'.$this->faker->randomElement(['gmail.com', 'hotmail.com', 'yahoo.es', 'outlook.com']),
            'activo'   => $this->faker->boolean(90),
        ];
    }

    public function activo(): static
    {
        return $this->state(['activo' => true]);
    }

    public function inactivo(): static
    {
        return $this->state(['activo' => false]);
    }
}
