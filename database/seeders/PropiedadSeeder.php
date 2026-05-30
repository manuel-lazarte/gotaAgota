<?php

namespace Database\Seeders;

use App\Models\Alerta;
use App\Models\CuotaAgua;
use App\Models\Familia;
use App\Models\Medidor;
use App\Models\Consumo;
use App\Models\Propiedad;
use App\Models\Socio;
use App\Models\TanqueComunitario;
use Illuminate\Database\Seeder;

class PropiedadSeeder extends Seeder
{
    // Litros por persona por mes (estándar OMS: 50L/día * 30)
    private const LITROS_POR_PERSONA = 1500;

    public function run(): void
    {
        $this->command->info('Creando propiedades, familias, medidores y consumos...');

        $socios = Socio::all();

        $socios->each(function (Socio $socio) {
            // Cada socio tiene 1-2 propiedades
            $numPropiedades = fake()->numberBetween(1, 2);

            Propiedad::factory($numPropiedades)->activa()->create([
                'socio_id' => $socio->id,
            ])->each(function (Propiedad $propiedad) {
                // 1 familia por propiedad (puede tener más en futuras versiones)
                $familia = Familia::factory()->create([
                    'propiedad_id' => $propiedad->id,
                ]);

                // Cuota de agua para los últimos 3 meses
                $this->crearCuotas($familia);

                // 1 medidor activo por propiedad
                $medidor = Medidor::factory()->activo()->create([
                    'propiedad_id' => $propiedad->id,
                ]);

                // Historial de consumos: últimos 6 meses
                $this->crearHistorialConsumos($medidor->id);
            });
        });

        $this->command->info('  ✔ '.Propiedad::count().' propiedades creadas');
        $this->command->info('  ✔ '.Familia::count().' familias registradas');
        $this->command->info('  ✔ '.Medidor::count().' medidores instalados');
        $this->command->info('  ✔ '.Consumo::count().' lecturas de consumo registradas');
        $this->command->info('  ✔ '.CuotaAgua::count().' cuotas de agua asignadas');

        $this->command->info('Creando tanque comunitario y alertas...');
        $this->crearTanque();
        $this->crearAlertas();
    }

    private function crearCuotas(Familia $familia): void
    {
        $litros = $familia->num_integrantes * self::LITROS_POR_PERSONA;

        for ($i = 2; $i >= 0; $i--) {
            $periodo = now()->subMonths($i)->format('Y-m');
            CuotaAgua::create([
                'familia_id'       => $familia->id,
                'litros_asignados' => $litros,
                'periodo'          => $periodo,
            ]);
        }
    }

    private function crearHistorialConsumos(int $medidorId): void
    {
        $lecturaActual = fake()->randomFloat(2, 100, 500);

        for ($mes = 5; $mes >= 0; $mes--) {
            $incremento    = fake()->randomFloat(2, 10, 70);
            $lecturaAnterior = $lecturaActual;
            $lecturaActual   = round($lecturaAnterior + $incremento, 2);

            $fecha = now()->subMonths($mes)->startOfMonth()->format('Y-m-d');

            Consumo::create([
                'medidor_id'       => $medidorId,
                'lectura_anterior' => $lecturaAnterior,
                'lectura_actual'   => $lecturaActual,
                'consumo'          => round($incremento, 2),
                'fecha_lectura'    => $fecha,
            ]);
        }
    }

    private function crearTanque(): void
    {
        // Tanque con nivel al 65% — estado PRECAUCION
        TanqueComunitario::create([
            'capacidad_total' => 500000,   // 500,000 litros
            'nivel_actual'    => 325000,   // 65%
            'fecha_registro'  => now(),
        ]);

        // Registro histórico hace 1 mes (nivel más alto)
        TanqueComunitario::create([
            'capacidad_total' => 500000,
            'nivel_actual'    => 420000,   // 84%
            'fecha_registro'  => now()->subMonth(),
        ]);

        $this->command->info('  ✔ Tanque comunitario registrado (nivel actual: 65%)');
    }

    private function crearAlertas(): void
    {
        Alerta::create([
            'tipo'    => 'PRECAUCION',
            'mensaje' => 'El nivel del tanque está al 65%. Se recomienda uso moderado del agua.',
            'activa'  => true,
        ]);

        Alerta::create([
            'tipo'    => 'RESTRICCION',
            'mensaje' => 'Periodo de estiaje detectado. Restricción de uso no esencial hasta nuevo aviso.',
            'activa'  => false,
        ]);

        $this->command->info('  ✔ Alertas del sistema creadas');
    }
}
