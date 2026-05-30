<?php

namespace App\Http\Requests\Alerta;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlertaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tipo'    => 'required|in:PRECAUCION,RESTRICCION,RACIONAMIENTO',
            'mensaje' => 'required|string',
            'activa'  => 'boolean',
        ];
    }
}
