<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FamiliaResource extends JsonResource
{
    public function toArray($request): array
    {
        $propiedad = $this->relationLoaded('propiedad') ? $this->propiedad : null;
        $socio     = $propiedad?->relationLoaded('socio') ? $propiedad->socio : null;
        $cuota     = $this->relationLoaded('cuotas')
            ? $this->cuotas->sortByDesc('periodo')->first()
            : null;
        $medidor   = $propiedad?->relationLoaded('medidores')
            ? $propiedad->medidores->first()
            : null;
        $telefono  = $socio?->relationLoaded('telefonos')
            ? ($socio->telefonos->firstWhere('es_principal', true) ?? $socio->telefonos->first())
            : null;

        return [
            'id'              => $this->id,
            'propiedad_id'    => $this->propiedad_id,
            'nombre'          => $this->nombre,
            'iniciales'       => $this->getIniciales(),
            'num_integrantes' => $this->num_integrantes,
            'zona'            => match ($this->id % 3) {
                0       => 'ZONA NORTE',
                1       => 'CENTRO',
                default => 'SUR',
            },
            'direccion'       => $propiedad?->direccion,
            'estado'          => $propiedad?->estado,
            'cuota_mensual'   => $cuota?->litros_asignados,
            'cuota_diaria'    => $cuota ? round($cuota->litros_asignados / 30) : null,
            'periodo_cuota'   => $cuota?->periodo,
            'contacto'        => $telefono?->numero,
            'socio'           => $socio ? [
                'id'     => $socio->id,
                'nombre' => $socio->nombre.' '.$socio->apellido,
                'activo' => $socio->activo,
            ] : null,
            'medidor'         => $medidor ? [
                'id'           => $medidor->id,
                'numero_serie' => $medidor->numero_serie,
                'activo'       => $medidor->activo,
            ] : null,
        ];
    }

    private function getIniciales(): string
    {
        $partes = explode(' ', $this->nombre);
        if (count($partes) >= 2) {
            return mb_strtoupper(mb_substr($partes[0], 0, 1).mb_substr($partes[1], 0, 1));
        }
        return mb_strtoupper(mb_substr($this->nombre, 0, 2));
    }
}
