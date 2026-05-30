<?php

namespace App\Http\Requests\Medidor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedidorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'propiedad_id'      => 'sometimes|exists:propiedads,id',
            'numero_serie'      => 'sometimes|string|max:50|unique:medidors,numero_serie,'.$this->route('medidor'),
            'fecha_instalacion' => 'sometimes|date',
            'activo'            => 'boolean',
        ];
    }
}
