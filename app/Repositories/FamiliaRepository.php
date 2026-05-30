<?php

namespace App\Repositories;

use App\Models\Familia;
use App\Repositories\Contracts\FamiliaRepositoryInterface;

class FamiliaRepository implements FamiliaRepositoryInterface
{
    public function __construct(private Familia $model) {}

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
        $familia = $this->findById($id);
        $familia->update($data);
        return $familia->fresh();
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
