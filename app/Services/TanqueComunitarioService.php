<?php

namespace App\Services;

use App\Repositories\Contracts\TanqueComunitarioRepositoryInterface;

class TanqueComunitarioService
{
    public function __construct(private TanqueComunitarioRepositoryInterface $repository) {}

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
        $data['fecha_registro'] = $data['fecha_registro'] ?? now();
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

    public function getUltimoRegistro(): mixed
    {
        return $this->repository->getUltimoRegistro();
    }

    public function getPorcentajeDisponible(): float
    {
        $tanque = $this->getUltimoRegistro();
        if (!$tanque || $tanque->capacidad_total == 0) {
            return 0;
        }
        return round(($tanque->nivel_actual / $tanque->capacidad_total) * 100, 2);
    }
}
