<?php

namespace App\Repositories\Contracts;

interface PagoRepositoryInterface extends BaseRepositoryInterface
{
    public function getPendientesBySocio(int $socioId): mixed;
}
