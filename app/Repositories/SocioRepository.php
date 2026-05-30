<?php

namespace App\Repositories;

use App\Models\Socio;
use App\Repositories\Contracts\SocioRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SocioRepository implements SocioRepositoryInterface
{
    public function __construct(private Socio $model) {}

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
        $socio = $this->findById($id);
        $socio->update($data);
        return $socio->fresh();
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function findByCedula(string $cedula): mixed
    {
        return $this->model->where('cedula', $cedula)->first();
    }
}
