<?php

namespace App\Http\Requests\Telefono;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTelefonoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'numero'      => 'sometimes|string|max:20',
            'es_principal' => 'boolean',
        ];
    }
}
