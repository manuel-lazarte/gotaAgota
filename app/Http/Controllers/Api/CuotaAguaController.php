<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CuotaAgua\StoreCuotaAguaRequest;
use App\Http\Requests\CuotaAgua\UpdateCuotaAguaRequest;
use App\Http\Resources\CuotaAguaResource;
use App\Services\CuotaAguaService;
use Illuminate\Http\JsonResponse;

class CuotaAguaController extends Controller
{
    public function __construct(private CuotaAguaService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(CuotaAguaResource::collection($this->service->getAll()));
    }

    public function store(StoreCuotaAguaRequest $request): JsonResponse
    {
        $cuota = $this->service->create($request->validated());
        return response()->json(new CuotaAguaResource($cuota), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new CuotaAguaResource($this->service->findById($id)));
    }

    public function update(UpdateCuotaAguaRequest $request, int $id): JsonResponse
    {
        $cuota = $this->service->update($id, $request->validated());
        return response()->json(new CuotaAguaResource($cuota));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
