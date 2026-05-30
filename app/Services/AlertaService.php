<?php

namespace App\Services;

use App\Repositories\Contracts\AlertaRepositoryInterface;

class AlertaService
{
    public function __construct(private AlertaRepositoryInterface $repository) {}

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
        $data['activa'] = $data['activa'] ?? true;
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

    public function getActivas(): mixed
    {
        return $this->repository->getActivas();
    }

    public function getByTipo(string $tipo): mixed
    {
        return $this->repository->getByTipo($tipo);
    }
}
