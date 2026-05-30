<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Socio\StoreSocioRequest;
use App\Http\Requests\Socio\UpdateSocioRequest;
use App\Http\Resources\SocioResource;
use App\Services\SocioService;
use Illuminate\Http\JsonResponse;

class SocioController extends Controller
{
    public function __construct(private SocioService $service) {}

    public function index(): JsonResponse
    {
        return response()->json(SocioResource::collection($this->service->getAll()));
    }

    public function store(StoreSocioRequest $request): JsonResponse
    {
        $socio = $this->service->create($request->validated());
        return response()->json(new SocioResource($socio), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new SocioResource($this->service->findById($id)));
    }

    public function update(UpdateSocioRequest $request, int $id): JsonResponse
    {
        $socio = $this->service->update($id, $request->validated());
        return response()->json(new SocioResource($socio));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
