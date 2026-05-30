<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Familia\StoreFamiliaRequest;
use App\Http\Requests\Familia\UpdateFamiliaRequest;
use App\Http\Resources\FamiliaResource;
use App\Http\Resources\ConsumoResource;
use App\Models\Familia;
use App\Services\FamiliaService;
use Illuminate\Http\JsonResponse;

class FamiliaController extends Controller
{
    public function __construct(private FamiliaService $service) {}

    public function index(): JsonResponse
    {
        $familias = Familia::with([
            'propiedad.socio.telefonos',
            'propiedad.medidores',
            'cuotas',
        ])->get();

        return response()->json(FamiliaResource::collection($familias));
    }

    public function store(StoreFamiliaRequest $request): JsonResponse
    {
        $familia = $this->service->create($request->validated());
        return response()->json(new FamiliaResource($familia), 201);
    }

    public function show(int $id): JsonResponse
    {
        $familia = Familia::with([
            'propiedad.socio.telefonos',
            'propiedad.medidores.consumos',
            'cuotas',
        ])->findOrFail($id);

        $medidor = $familia->propiedad?->medidores?->first();

        $consumosRecientes = $medidor
            ? $medidor->consumos
                ->sortByDesc('fecha_lectura')
                ->take(6)
                ->values()
                ->map(fn($c) => [
                    'id'             => $c->id,
                    'fecha_lectura'  => $c->fecha_lectura,
                    'consumo'        => $c->consumo,
                    'lectura_actual' => $c->lectura_actual,
                ])
            : [];

        $data = (new FamiliaResource($familia))->toArray(request());
        $data['consumo_ultimo']    = $consumosRecientes[0]['consumo'] ?? null;
        $data['consumos_recientes'] = $consumosRecientes;

        return response()->json($data);
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
