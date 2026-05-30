<?php

namespace App\Http\Requests\Telefono;

use Illuminate\Foundation\Http\FormRequest;

class StoreTelefonoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'numero'      => 'required|string|max:20',
            'es_principal' => 'boolean',
        ];
    }
}
