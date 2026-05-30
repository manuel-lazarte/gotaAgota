<?php

namespace App\Http\Requests\Medidor;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedidorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'propiedad_id'      => 'required|exists:propiedads,id',
            'numero_serie'      => 'required|string|max:50|unique:medidors,numero_serie',
            'fecha_instalacion' => 'required|date',
            'activo'            => 'boolean',
        ];
    }
}
