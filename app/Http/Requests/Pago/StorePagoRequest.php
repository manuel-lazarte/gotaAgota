<?php

namespace App\Http\Requests\Pago;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'socio_id'   => 'required|exists:socios,id',
            'consumo_id' => 'nullable|exists:consumos,id',
            'monto'      => 'required|numeric|min:0',
            'estado'     => 'in:PENDIENTE,PAGADO,VENCIDO',
            'fecha_pago' => 'nullable|date',
        ];
    }
}
