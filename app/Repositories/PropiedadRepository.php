<?php

namespace App\Repositories;

use App\Models\Propiedad;
use App\Repositories\Contracts\PropiedadRepositoryInterface;

class PropiedadRepository implements PropiedadRepositoryInterface
{
    public function __construct(private Propiedad $model) {}

    public function all(): mixed
    {
        return $this->model->all();
    }

    public function findById(int $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $propiedad = $this->findById($id);
        $propiedad->update($data);
        return $propiedad->fresh();
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function getBySocio(int $socioId): mixed
    {
        return $this->model->where('socio_id', $socioId)->get();
    }
}
