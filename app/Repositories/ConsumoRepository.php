<?php

namespace App\Repositories;

use App\Models\Consumo;
use App\Repositories\Contracts\ConsumoRepositoryInterface;

class ConsumoRepository implements ConsumoRepositoryInterface
{
    public function __construct(private Consumo $model) {}

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
        $consumo = $this->findById($id);
        $consumo->update($data);
        return $consumo->fresh();
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function getByMedidor(int $medidorId): mixed
    {
        return $this->model->where('medidor_id', $medidorId)->orderBy('fecha_lectura', 'desc')->get();
    }

    public function getUltimoByMedidor(int $medidorId): mixed
    {
        return $this->model->where('medidor_id', $medidorId)->orderBy('fecha_lectura', 'desc')->first();
    }
}
