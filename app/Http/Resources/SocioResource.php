<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocioResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'nombre'    => $this->nombre,
            'apellido'  => $this->apellido,
            'cedula'    => $this->cedula,
            'email'     => $this->email,
            'activo'    => $this->activo,
            'creado_en' => $this->created_at,
        ];
    }
}
