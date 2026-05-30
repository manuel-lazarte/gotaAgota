<?php

namespace App\Repositories;

use App\Models\TanqueComunitario;
use App\Repositories\Contracts\TanqueComunitarioRepositoryInterface;

class TanqueComunitarioRepository implements TanqueComunitarioRepositoryInterface
{
    public function __construct(private TanqueComunitario $model) {}

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
        $tanque = $this->findById($id);
        $tanque->update($data);
        return $tanque->fresh();
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function getUltimoRegistro(): mixed
    {
        return $this->model->orderBy('fecha_registro', 'desc')->first();
    }
}
