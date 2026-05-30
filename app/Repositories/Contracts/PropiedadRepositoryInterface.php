<?php

namespace App\Repositories\Contracts;

interface PropiedadRepositoryInterface extends BaseRepositoryInterface
{
    public function getBySocio(int $socioId): mixed;
}
