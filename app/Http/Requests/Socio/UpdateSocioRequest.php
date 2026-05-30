<?php

namespace App\Http\Requests\Socio;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocioRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nombre'   => 'sometimes|string|max:100',
            'apellido' => 'sometimes|string|max:100',
            'cedula'   => 'sometimes|string|max:20|unique:socios,cedula,'.$this->route('socio'),
            'email'    => 'nullable|email|unique:socios,email,'.$this->route('socio'),
            'activo'   => 'boolean',
        ];
    }
}
