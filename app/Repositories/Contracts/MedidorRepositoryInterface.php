<?php

namespace App\Repositories\Contracts;

interface MedidorRepositoryInterface extends BaseRepositoryInterface
{
    public function getByPropiedad(int $propiedadId): mixed;
}
