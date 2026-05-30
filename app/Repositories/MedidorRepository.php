<?php

namespace App\Repositories;

use App\Models\Medidor;
use App\Repositories\Contracts\MedidorRepositoryInterface;

class MedidorRepository implements MedidorRepositoryInterface
{
    public function __construct(private Medidor $model) {}

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
        $medidor = $this->findById($id);
        $medidor->update($data);
        return $medidor->fresh();
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function getByPropiedad(int $propiedadId): mixed
    {
        return $this->model->where('propiedad_id', $propiedadId)->get();
    }
}
