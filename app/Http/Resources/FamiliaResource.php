<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FamiliaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'              => $this->id,
            'propiedad_id'    => $this->propiedad_id,
            'nombre'          => $this->nombre,
            'num_integrantes' => $this->num_integrantes,
        ];
    }
}
