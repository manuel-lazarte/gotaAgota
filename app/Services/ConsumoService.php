<?php

namespace App\Services;

use App\Repositories\Contracts\ConsumoRepositoryInterface;

class ConsumoService
{
    public function __construct(
        private ConsumoRepositoryInterface $repository,
        private MotorConsumoService $motorConsumo,
    ) {}

    public function getAll(): mixed
    {
        return $this->repository->all();
    }

    public function findById(int $id): mixed
    {
        return $this->repository->findById($id);
    }

    public function registrarLectura(array $data): mixed
    {
        $ultimoConsumo = $this->repository->getUltimoByMedidor($data['medidor_id']);
        $lecturaAnterior = $ultimoConsumo ? $ultimoConsumo->lectura_actual : 0;

        $data['lectura_anterior'] = $lecturaAnterior;
        $data['consumo'] = $this->motorConsumo->calcularConsumo($lecturaAnterior, $data['lectura_actual']);

        return $this->repository->create($data);
    }

    public function getByMedidor(int $medidorId): mixed
    {
        return $this->repository->getByMedidor($medidorId);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
