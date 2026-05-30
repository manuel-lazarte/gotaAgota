<?php

namespace App\Http\Requests\TanqueComunitario;

use Illuminate\Foundation\Http\FormRequest;

class StoreTanqueRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'capacidad_total' => 'required|numeric|min:0',
            'nivel_actual'    => 'required|numeric|min:0',
            'fecha_registro'  => 'nullable|date',
        ];
    }
}
