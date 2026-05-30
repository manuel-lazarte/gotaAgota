<?php

namespace App\Http\Requests\Pago;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePagoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'monto'      => 'sometimes|numeric|min:0',
            'estado'     => 'sometimes|in:PENDIENTE,PAGADO,VENCIDO',
            'fecha_pago' => 'nullable|date',
        ];
    }
}
