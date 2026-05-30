<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropiedadResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'socio_id'    => $this->socio_id,
            'descripcion' => $this->descripcion,
            'direccion'   => $this->direccion,
            'estado'      => $this->estado,
        ];
    }
}
