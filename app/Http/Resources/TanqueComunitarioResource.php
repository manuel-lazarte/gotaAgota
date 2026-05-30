<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TanqueComunitarioResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'              => $this->id,
            'capacidad_total' => $this->capacidad_total,
            'nivel_actual'    => $this->nivel_actual,
            'porcentaje'      => $this->capacidad_total > 0
                ? round(($this->nivel_actual / $this->capacidad_total) * 100, 2)
                : 0,
            'fecha_registro'  => $this->fecha_registro,
        ];
    }
}
