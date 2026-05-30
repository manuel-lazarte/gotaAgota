<?php

namespace App\Repositories\Contracts;

interface CuotaAguaRepositoryInterface extends BaseRepositoryInterface
{
    public function getByFamilia(int $familiaId): mixed;
}
