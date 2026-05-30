<?php

namespace App\Repositories\Contracts;

interface FamiliaRepositoryInterface extends BaseRepositoryInterface
{
    public function getByPropiedad(int $propiedadId): mixed;
}
