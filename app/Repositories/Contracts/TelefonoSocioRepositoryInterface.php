<?php

namespace App\Repositories\Contracts;

interface TelefonoSocioRepositoryInterface extends BaseRepositoryInterface
{
    public function getBySocio(int $socioId): mixed;
}
