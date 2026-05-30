<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Telefono\StoreTelefonoRequest;
use App\Http\Requests\Telefono\UpdateTelefonoRequest;
use App\Http\Resources\TelefonoSocioResource;
use App\Services\TelefonoSocioService;
use Illuminate\Http\JsonResponse;

class TelefonoSocioController extends Controller
{
    public function __construct(private TelefonoSocioService $service) {}

    public function index(int $socioId): JsonResponse
    {
        return response()->json(TelefonoSocioResource::collection($this->service->getBySocio($socioId)));
    }

    public function store(StoreTelefonoRequest $request, int $socioId): JsonResponse
    {
        $data = array_merge($request->validated(), ['socio_id' => $socioId]);
        $telefono = $this->service->create($data);
        return response()->json(new TelefonoSocioResource($telefono), 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(new TelefonoSocioResource($this->service->findById($id)));
    }

    public function update(UpdateTelefonoRequest $request, int $id): JsonResponse
    {
        $telefono = $this->service->update($id, $request->validated());
        return response()->json(new TelefonoSocioResource($telefono));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
