<?php

namespace App\Services;

use App\Repositories\Contracts\ConsumoRepositoryInterface;
use App\Repositories\Contracts\MedidorRepositoryInterface;

class MotorConsumoService
{
    public function __construct(
        private ConsumoRepositoryInterface $consumoRepository,
        private MedidorRepositoryInterface $medidorRepository,
    ) {}

    public function calcularConsumo(float $lecturaAnterior, float $lecturaActual): float
    {
        return max(0, $lecturaActual - $lecturaAnterior);
    }

    public function getEstadisticasByMedidor(int $medidorId): array
    {
        $consumos = $this->consumoRepository->getByMedidor($medidorId);

        if ($consumos->isEmpty()) {
            return ['total' => 0, 'promedio' => 0, 'maximo' => 0, 'minimo' => 0, 'registros' => 0];
        }

        $valores = $consumos->pluck('consumo');

        return [
            'total'     => $valores->sum(),
            'promedio'  => round($valores->avg(), 2),
            'maximo'    => $valores->max(),
            'minimo'    => $valores->min(),
            'registros' => $consumos->count(),
        ];
    }
}
