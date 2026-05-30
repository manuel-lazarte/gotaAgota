<?php

namespace Database\Seeders;

use App\Models\Socio;
use App\Models\TelefonoSocio;
use Database\Factories\TelefonoSocioFactory;
use Illuminate\Database\Seeder;

class SocioSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Creando socios...');

        // 20 socios activos con 1-2 teléfonos cada uno
        Socio::factory(20)->activo()->create()->each(function (Socio $socio) {
            // Teléfono principal
            TelefonoSocio::factory()->principal()->create([
                'socio_id' => $socio->id,
            ]);

            // 50% de socios tienen un segundo teléfono
            if (fake()->boolean(50)) {
                TelefonoSocio::factory()->create([
                    'socio_id'    => $socio->id,
                    'es_principal' => false,
                ]);
            }
        });

        // 5 socios inactivos (suspendidos o dados de baja)
        Socio::factory(5)->inactivo()->create()->each(function (Socio $socio) {
            TelefonoSocio::factory()->principal()->create(['socio_id' => $socio->id]);
        });

        $this->command->info('  ✔ '.Socio::count().' socios creados');
        $this->command->info('  ✔ '.TelefonoSocio::count().' teléfonos registrados');
    }
}
