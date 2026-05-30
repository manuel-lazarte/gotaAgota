<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pago\StorePagoRequest;
use App\Http\Requests\Pago\UpdatePagoRequest;
use App\Http\Resources\PagoResource;
use App\Services\PagoService;
use Illuminate\Http\JsonResponse;

class PagoController extends Controller
{
    public function __construct(private PagoService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(PagoResource::collection($this->service->getAll()));
    }

    public function store(StorePagoRequest $request): JsonResponse
    {
        $pago = $this->service->create($request->validated());
        return response()->json(new PagoResource($pago), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new PagoResource($this->service->findById($id)));
    }

    public function update(UpdatePagoRequest $request, int $id): JsonResponse
    {
        $pago = $this->service->update($id, $request->validated());
        return response()->json(new PagoResource($pago));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }

    public function pendientes(int $socioId): JsonResponse
    {
        return response()->json(PagoResource::collection($this->service->getPendientesBySocio($socioId)));
    }
}
