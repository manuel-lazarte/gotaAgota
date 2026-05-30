<?php

namespace App\Repositories;

use App\Models\Alerta;
use App\Repositories\Contracts\AlertaRepositoryInterface;

class AlertaRepository implements AlertaRepositoryInterface
{
    public function __construct(private Alerta $model) {}

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
        $alerta = $this->findById($id);
        $alerta->update($data);
        return $alerta->fresh();
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function getActivas(): mixed
    {
        return $this->model->where('activa', true)->get();
    }

    public function getByTipo(string $tipo): mixed
    {
        return $this->model->where('tipo', $tipo)->get();
    }
}
