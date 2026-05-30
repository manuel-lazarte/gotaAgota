<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PagoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'socio_id'   => $this->socio_id,
            'consumo_id' => $this->consumo_id,
            'monto'      => $this->monto,
            'estado'     => $this->estado,
            'fecha_pago' => $this->fecha_pago,
        ];
    }
}
