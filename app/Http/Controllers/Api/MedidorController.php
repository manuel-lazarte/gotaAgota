<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medidor\StoreMedidorRequest;
use App\Http\Requests\Medidor\UpdateMedidorRequest;
use App\Http\Resources\MedidorResource;
use App\Services\MedidorService;
use Illuminate\Http\JsonResponse;

class MedidorController extends Controller
{
    public function __construct(private MedidorService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(MedidorResource::collection($this->service->getAll()));
    }

    public function store(StoreMedidorRequest $request): JsonResponse
    {
        $medidor = $this->service->create($request->validated());
        return response()->json(new MedidorResource($medidor), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new MedidorResource($this->service->findById($id)));
    }

    public function update(UpdateMedidorRequest $request, int $id): JsonResponse
    {
        $medidor = $this->service->update($id, $request->validated());
        return response()->json(new MedidorResource($medidor));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
