<?php

namespace App\Http\Requests\CuotaAgua;

use Illuminate\Foundation\Http\FormRequest;

class StoreCuotaAguaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'familia_id'       => 'required|exists:familias,id',
            'litros_asignados' => 'sometimes|numeric|min:0',
            'num_integrantes'  => 'sometimes|integer|min:1',
            'periodo'          => 'required|string|regex:/^\d{4}-(0[1-9]|1[0-2])$/',
        ];
    }
}
