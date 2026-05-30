<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = ['socio_id', 'consumo_id', 'monto', 'estado', 'fecha_pago'];

    protected $casts = ['fecha_pago' => 'date'];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function consumo()
    {
        return $this->belongsTo(Consumo::class);
    }
}
