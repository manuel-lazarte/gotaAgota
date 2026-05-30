<?php

namespace App\Http\Requests\Alerta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlertaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tipo'    => 'sometimes|in:PRECAUCION,RESTRICCION,RACIONAMIENTO',
            'mensaje' => 'sometimes|string',
            'activa'  => 'boolean',
        ];
    }
}
