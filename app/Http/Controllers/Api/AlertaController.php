<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alerta\StoreAlertaRequest;
use App\Http\Requests\Alerta\UpdateAlertaRequest;
use App\Http\Resources\AlertaResource;
use App\Services\AlertaService;
use Illuminate\Http\JsonResponse;

class AlertaController extends Controller
{
    public function __construct(private AlertaService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(AlertaResource::collection($this->service->getAll()));
    }

    public function store(StoreAlertaRequest $request): JsonResponse
    {
        $alerta = $this->service->create($request->validated());
        return response()->json(new AlertaResource($alerta), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new AlertaResource($this->service->findById($id)));
    }

    public function update(UpdateAlertaRequest $request, int $id): JsonResponse
    {
        $alerta = $this->service->update($id, $request->validated());
        return response()->json(new AlertaResource($alerta));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }

    public function activas(): JsonResponse
    {
        return response()->json(AlertaResource::collection($this->service->getActivas()));
    }
}
