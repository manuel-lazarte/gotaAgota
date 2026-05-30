<?php

namespace App\Services;

use App\Repositories\Contracts\TanqueComunitarioRepositoryInterface;
use App\Repositories\Contracts\FamiliaRepositoryInterface;
use App\Repositories\Contracts\CuotaAguaRepositoryInterface;

class MotorRacionamientoService
{
    // Umbrales de nivel del tanque para cambio de estado
    private const UMBRAL_PRECAUCION   = 50.0;
    private const UMBRAL_RESTRICCION  = 30.0;
    private const UMBRAL_RACIONAMIENTO = 15.0;

    public function __construct(
        private TanqueComunitarioRepositoryInterface $tanqueRepository,
        private FamiliaRepositoryInterface $familiaRepository,
        private CuotaAguaRepositoryInterface $cuotaRepository,
    ) {}

    public function evaluarEstado(): string
    {
        $tanque = $this->tanqueRepository->getUltimoRegistro();

        if (!$tanque || $tanque->capacidad_total == 0) {
            return 'NORMAL';
        }

        $porcentaje = ($tanque->nivel_actual / $tanque->capacidad_total) * 100;

        return match (true) {
            $porcentaje <= self::UMBRAL_RACIONAMIENTO => 'RACIONAMIENTO',
            $porcentaje <= self::UMBRAL_RESTRICCION   => 'RESTRICCION',
            $porcentaje <= self::UMBRAL_PRECAUCION    => 'PRECAUCION',
            default                                   => 'NORMAL',
        };
    }

    public function calcularDemandaTotal(): float
    {
        $familias = $this->familiaRepository->all();
        $demanda  = 0;

        foreach ($familias as $familia) {
            $cuota = $this->cuotaRepository->getByFamilia($familia->id)->first();
            if ($cuota) {
                $demanda += $cuota->litros_asignados;
            }
        }

        return $demanda;
    }

    public function getResumen(): array
    {
        $tanque     = $this->tanqueRepository->getUltimoRegistro();
        $estado     = $this->evaluarEstado();
        $demanda    = $this->calcularDemandaTotal();
        $disponible = $tanque ? $tanque->nivel_actual : 0;

        return [
            'estado'            => $estado,
            'nivel_actual'      => $disponible,
            'capacidad_total'   => $tanque?->capacidad_total ?? 0,
            'demanda_total'     => $demanda,
            'superavit_deficit' => $disponible - $demanda,
        ];
    }
}
