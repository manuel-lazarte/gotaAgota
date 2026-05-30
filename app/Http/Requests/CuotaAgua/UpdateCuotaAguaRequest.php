<?php

namespace App\Http\Requests\CuotaAgua;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCuotaAguaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'litros_asignados' => 'sometimes|numeric|min:0',
            'periodo'          => 'sometimes|string|regex:/^\d{4}-(0[1-9]|1[0-2])$/',
        ];
    }
}
