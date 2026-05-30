<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TanqueComunitario\StoreTanqueRequest;
use App\Http\Requests\TanqueComunitario\UpdateTanqueRequest;
use App\Http\Resources\TanqueComunitarioResource;
use App\Services\TanqueComunitarioService;
use App\Services\MotorRacionamientoService;
use Illuminate\Http\JsonResponse;

class TanqueComunitarioController extends Controller
{
    public function __construct(
        private TanqueComunitarioService $service,
        private MotorRacionamientoService $motorRacionamiento,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json(TanqueComunitarioResource::collection($this->service->getAll()));
    }

    public function store(StoreTanqueRequest $request): JsonResponse
    {
        $tanque = $this->service->create($request->validated());
        return response()->json(new TanqueComunitarioResource($tanque), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new TanqueComunitarioResource($this->service->findById($id)));
    }

    public function update(UpdateTanqueRequest $request, int $id): JsonResponse
    {
        $tanque = $this->service->update($id, $request->validated());
        return response()->json(new TanqueComunitarioResource($tanque));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }

    public function resumen(): JsonResponse
    {
        return response()->json($this->motorRacionamiento->getResumen());
    }
}
