<?php

namespace App\Services;

use App\Repositories\Contracts\AlertaRepositoryInterface;

class MotorNotificacionesService
{
    private const MENSAJES = [
        'PRECAUCION'    => 'El nivel del tanque está por debajo del 50%. Se recomienda uso moderado del agua.',
        'RESTRICCION'   => 'El nivel del tanque está por debajo del 30%. Restricción de uso no esencial.',
        'RACIONAMIENTO' => 'El nivel del tanque está por debajo del 15%. Racionamiento activo.',
    ];

    public function __construct(
        private AlertaRepositoryInterface $alertaRepository,
        private MotorRacionamientoService $motorRacionamiento,
    ) {}

    public function generarAlertaSegunEstado(): mixed
    {
        $estado = $this->motorRacionamiento->evaluarEstado();

        if ($estado === 'NORMAL') {
            return null;
        }

        return $this->alertaRepository->create([
            'tipo'    => $estado,
            'mensaje' => self::MENSAJES[$estado],
            'activa'  => true,
        ]);
    }

    public function crearAlerta(string $tipo, string $mensaje): mixed
    {
        return $this->alertaRepository->create([
            'tipo'    => $tipo,
            'mensaje' => $mensaje,
            'activa'  => true,
        ]);
    }
}
