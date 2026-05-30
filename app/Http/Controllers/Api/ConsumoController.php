<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Consumo\StoreConsumoRequest;
use App\Http\Resources\ConsumoResource;
use App\Services\ConsumoService;
use App\Services\MotorNotificacionesService;
use Illuminate\Http\JsonResponse;

class ConsumoController extends Controller
{
    public function __construct(
        private ConsumoService $service,
        private MotorNotificacionesService $motorNotificaciones,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json(ConsumoResource::collection($this->service->getAll()));
    }

    public function store(StoreConsumoRequest $request): JsonResponse
    {
        $consumo = $this->service->registrarLectura($request->validated());
        $this->motorNotificaciones->generarAlertaSegunEstado();
        return response()->json(new ConsumoResource($consumo), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new ConsumoResource($this->service->findById($id)));
    }

    public function porMedidor(int $medidorId): JsonResponse
    {
        return response()->json(ConsumoResource::collection($this->service->getByMedidor($medidorId)));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
