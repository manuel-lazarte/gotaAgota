<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsumoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'medidor_id'       => $this->medidor_id,
            'lectura_anterior' => $this->lectura_anterior,
            'lectura_actual'   => $this->lectura_actual,
            'consumo'          => $this->consumo,
            'fecha_lectura'    => $this->fecha_lectura,
        ];
    }
}
