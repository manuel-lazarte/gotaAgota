<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedidorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'propiedad_id'      => $this->propiedad_id,
            'numero_serie'      => $this->numero_serie,
            'fecha_instalacion' => $this->fecha_instalacion,
            'activo'            => $this->activo,
        ];
    }
}
