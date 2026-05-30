<?php

namespace App\Http\Requests\Socio;

use Illuminate\Foundation\Http\FormRequest;

class StoreSocioRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'cedula'   => 'required|string|max:20|unique:socios,cedula',
            'email'    => 'nullable|email|unique:socios,email',
            'activo'   => 'boolean',
        ];
    }
}
