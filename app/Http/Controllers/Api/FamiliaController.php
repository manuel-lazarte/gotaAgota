<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Familia\StoreFamiliaRequest;
use App\Http\Requests\Familia\UpdateFamiliaRequest;
use App\Http\Resources\FamiliaResource;
use App\Services\FamiliaService;
use Illuminate\Http\JsonResponse;

class FamiliaController extends Controller
{
    public function __construct(private FamiliaService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(FamiliaResource::collection($this->service->getAll()));
    }

    public function store(StoreFamiliaRequest $request): JsonResponse
    {
        $familia = $this->service->create($request->validated());
        return response()->json(new FamiliaResource($familia), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new FamiliaResource($this->service->findById($id)));
    }

    public function update(UpdateFamiliaRequest $request, int $id): JsonResponse
    {
        $familia = $this->service->update($id, $request->validated());
        return response()->json(new FamiliaResource($familia));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
