<?php

namespace App\Repositories\Contracts;

interface TanqueComunitarioRepositoryInterface extends BaseRepositoryInterface
{
    public function getUltimoRegistro(): mixed;
}
