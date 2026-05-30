<?php

namespace App\Repositories;

use App\Models\TelefonoSocio;
use App\Repositories\Contracts\TelefonoSocioRepositoryInterface;

class TelefonoSocioRepository implements TelefonoSocioRepositoryInterface
{
    public function __construct(private TelefonoSocio $model) {}

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
        $telefono = $this->findById($id);
        $telefono->update($data);
        return $telefono->fresh();
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
