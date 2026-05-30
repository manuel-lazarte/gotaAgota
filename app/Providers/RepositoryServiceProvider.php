<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\SocioRepositoryInterface;
use App\Repositories\Contracts\TelefonoSocioRepositoryInterface;
use App\Repositories\Contracts\PropiedadRepositoryInterface;
use App\Repositories\Contracts\FamiliaRepositoryInterface;
use App\Repositories\Contracts\MedidorRepositoryInterface;
use App\Repositories\Contracts\ConsumoRepositoryInterface;
use App\Repositories\Contracts\PagoRepositoryInterface;
use App\Repositories\Contracts\CuotaAguaRepositoryInterface;
use App\Repositories\Contracts\AlertaRepositoryInterface;
use App\Repositories\Contracts\TanqueComunitarioRepositoryInterface;
use App\Repositories\SocioRepository;
use App\Repositories\TelefonoSocioRepository;
use App\Repositories\PropiedadRepository;
use App\Repositories\FamiliaRepository;
use App\Repositories\MedidorRepository;
use App\Repositories\ConsumoRepository;
use App\Repositories\PagoRepository;
use App\Repositories\CuotaAguaRepository;
use App\Repositories\AlertaRepository;
use App\Repositories\TanqueComunitarioRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SocioRepositoryInterface::class,           SocioRepository::class);
        $this->app->bind(TelefonoSocioRepositoryInterface::class,   TelefonoSocioRepository::class);
        $this->app->bind(PropiedadRepositoryInterface::class,       PropiedadRepository::class);
        $this->app->bind(FamiliaRepositoryInterface::class,         FamiliaRepository::class);
        $this->app->bind(MedidorRepositoryInterface::class,         MedidorRepository::class);
        $this->app->bind(ConsumoRepositoryInterface::class,         ConsumoRepository::class);
        $this->app->bind(PagoRepositoryInterface::class,            PagoRepository::class);
        $this->app->bind(CuotaAguaRepositoryInterface::class,       CuotaAguaRepository::class);
        $this->app->bind(AlertaRepositoryInterface::class,          AlertaRepository::class);
        $this->app->bind(TanqueComunitarioRepositoryInterface::class, TanqueComunitarioRepository::class);
    }

    public function boot(): void {}
}
