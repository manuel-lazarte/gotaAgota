<?php

namespace App\Repositories\Contracts;

interface SocioRepositoryInterface extends BaseRepositoryInterface
{
    public function findByCedula(string $cedula): mixed;
}
