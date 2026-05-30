<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlertaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'tipo'       => $this->tipo,
            'mensaje'    => $this->mensaje,
            'activa'     => $this->activa,
            'creado_en'  => $this->created_at,
        ];
    }
}
