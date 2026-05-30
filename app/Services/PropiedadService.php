<?php

namespace App\Services;

use App\Repositories\Contracts\PropiedadRepositoryInterface;

class PropiedadService
{
    public function __construct(private PropiedadRepositoryInterface $repository) {}

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

    public function getBySocio(int $socioId): mixed
    {
        return $this->repository->getBySocio($socioId);
    }
}
