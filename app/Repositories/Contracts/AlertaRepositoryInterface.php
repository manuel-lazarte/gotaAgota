<?php

namespace App\Repositories\Contracts;

interface AlertaRepositoryInterface extends BaseRepositoryInterface
{
    public function getActivas(): mixed;
    public function getByTipo(string $tipo): mixed;
}
