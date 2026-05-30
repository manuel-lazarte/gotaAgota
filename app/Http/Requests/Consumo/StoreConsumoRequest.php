<?php

namespace App\Http\Requests\Consumo;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsumoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'medidor_id'     => 'required|exists:medidors,id',
            'lectura_actual' => 'required|numeric|min:0',
            'fecha_lectura'  => 'required|date',
        ];
    }
}
