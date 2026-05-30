<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TelefonoSocioResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'socio_id'    => $this->socio_id,
            'numero'      => $this->numero,
            'es_principal' => $this->es_principal,
        ];
    }
}
