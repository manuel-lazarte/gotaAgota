<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SocioController;
use App\Http\Controllers\Api\TelefonoSocioController;
use App\Http\Controllers\Api\PropiedadController;
use App\Http\Controllers\Api\FamiliaController;
use App\Http\Controllers\Api\MedidorController;
use App\Http\Controllers\Api\ConsumoController;
use App\Http\Controllers\Api\PagoController;
use App\Http\Controllers\Api\CuotaAguaController;
use App\Http\Controllers\Api\AlertaController;
use App\Http\Controllers\Api\TanqueComunitarioController;

Route::prefix('v1')->group(function () {

    // Socios
    Route::apiResource('socios', SocioController::class);
    Route::get('socios/{socio}/telefonos', [TelefonoSocioController::class, 'index']);
    Route::post('socios/{socio}/telefonos', [TelefonoSocioController::class, 'store']);
    Route::get('socios/{socio}/pagos/pendientes', [PagoController::class, 'pendientes']);

    // Teléfonos (operaciones individuales)
    Route::get('telefonos/{id}',    [TelefonoSocioController::class, 'show']);
    Route::put('telefonos/{id}',    [TelefonoSocioController::class, 'update']);
    Route::delete('telefonos/{id}', [TelefonoSocioController::class, 'destroy']);

    // Propiedades
    Route::apiResource('propiedades', PropiedadController::class);

    // Familias
    Route::apiResource('familias', FamiliaController::class);

    // Medidores
    Route::apiResource('medidores', MedidorController::class);
    Route::get('medidores/{medidor}/consumos', [ConsumoController::class, 'porMedidor']);

    // Consumos
    Route::apiResource('consumos', ConsumoController::class)->except(['update']);

    // Pagos
    Route::apiResource('pagos', PagoController::class);

    // Cuotas de agua
    Route::apiResource('cuotas', CuotaAguaController::class);

    // Alertas
    Route::get('alertas/activas', [AlertaController::class, 'activas']);
    Route::apiResource('alertas', AlertaController::class);

    // Tanque comunitario
    Route::get('tanque/resumen', [TanqueComunitarioController::class, 'resumen']);
    Route::apiResource('tanque', TanqueComunitarioController::class);
});
