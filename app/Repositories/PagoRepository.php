<?php

namespace App\Repositories;

use App\Models\Pago;
use App\Repositories\Contracts\PagoRepositoryInterface;

class PagoRepository implements PagoRepositoryInterface
{
    public function __construct(private Pago $model) {}

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
        $pago = $this->findById($id);
        $pago->update($data);
        return $pago->fresh();
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function getPendientesBySocio(int $socioId): mixed
    {
        return $this->model->where('socio_id', $socioId)->where('estado', 'PENDIENTE')->get();
    }
}
