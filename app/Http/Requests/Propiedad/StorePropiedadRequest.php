<?php

namespace App\Http\Requests\Propiedad;

use Illuminate\Foundation\Http\FormRequest;

class StorePropiedadRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'socio_id'    => 'required|exists:socios,id',
            'descripcion' => 'nullable|string|max:255',
            'direccion'   => 'required|string|max:255',
            'estado'      => 'in:ACTIVA,INACTIVA,SUSPENDIDA',
        ];
    }
}
