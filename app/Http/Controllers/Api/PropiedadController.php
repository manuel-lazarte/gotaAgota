<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Propiedad\StorePropiedadRequest;
use App\Http\Requests\Propiedad\UpdatePropiedadRequest;
use App\Http\Resources\PropiedadResource;
use App\Services\PropiedadService;
use Illuminate\Http\JsonResponse;

class PropiedadController extends Controller
{
    public function __construct(private PropiedadService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(PropiedadResource::collection($this->service->getAll()));
    }

    public function store(StorePropiedadRequest $request): JsonResponse
    {
        $propiedad = $this->service->create($request->validated());
        return response()->json(new PropiedadResource($propiedad), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new PropiedadResource($this->service->findById($id)));
    }

    public function update(UpdatePropiedadRequest $request, int $id): JsonResponse
    {
        $propiedad = $this->service->update($id, $request->validated());
        return response()->json(new PropiedadResource($propiedad));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
