<?php

namespace App\Repositories;

use App\Models\CuotaAgua;
use App\Repositories\Contracts\CuotaAguaRepositoryInterface;

class CuotaAguaRepository implements CuotaAguaRepositoryInterface
{
    public function __construct(private CuotaAgua $model) {}

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
        $cuota = $this->findById($id);
        $cuota->update($data);
        return $cuota->fresh();
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function getByFamilia(int $familiaId): mixed
    {
        return $this->model->where('familia_id', $familiaId)->orderBy('periodo', 'desc')->get();
    }
}
