<?php

namespace App\Http\Requests\Familia;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamiliaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'propiedad_id'    => 'required|exists:propiedads,id',
            'nombre'          => 'required|string|max:100',
            'num_integrantes' => 'required|integer|min:1|max:50',
        ];
    }
}
