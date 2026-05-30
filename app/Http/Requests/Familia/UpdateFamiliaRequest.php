<?php

namespace App\Http\Requests\Familia;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFamiliaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'propiedad_id'    => 'sometimes|exists:propiedads,id',
            'nombre'          => 'sometimes|string|max:100',
            'num_integrantes' => 'sometimes|integer|min:1|max:50',
        ];
    }
}
