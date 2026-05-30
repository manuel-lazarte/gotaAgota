<?php

namespace App\Repositories\Contracts;

interface ConsumoRepositoryInterface extends BaseRepositoryInterface
{
    public function getByMedidor(int $medidorId): mixed;
    public function getUltimoByMedidor(int $medidorId): mixed;
}
