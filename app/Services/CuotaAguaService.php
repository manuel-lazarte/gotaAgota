<?php

namespace App\Services;

use App\Repositories\Contracts\CuotaAguaRepositoryInterface;

class CuotaAguaService
{
    // Litros por integrante al día (estándar OMS: 50L/persona/día * 30 días)
    private const LITROS_POR_INTEGRANTE_MES = 1500;

    public function __construct(private CuotaAguaRepositoryInterface $repository) {}

    public function getAll(): mixed
    {
        return $this->repository->all();
    }

    public function findById(int $id): mixed
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): mixed
    {
        if (!isset($data['litros_asignados']) && isset($data['num_integrantes'])) {
            $data['litros_asignados'] = $data['num_integrantes'] * self::LITROS_POR_INTEGRANTE_MES;
        }
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): mixed
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function getByFamilia(int $familiaId): mixed
    {
        return $this->repository->getByFamilia($familiaId);
    }
}
