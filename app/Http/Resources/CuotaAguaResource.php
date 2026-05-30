<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CuotaAguaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'familia_id'       => $this->familia_id,
            'litros_asignados' => $this->litros_asignados,
            'periodo'          => $this->periodo,
        ];
    }
}
