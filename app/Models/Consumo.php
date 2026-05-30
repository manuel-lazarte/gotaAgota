<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    use HasFactory;

    protected $fillable = ['medidor_id', 'lectura_anterior', 'lectura_actual', 'consumo', 'fecha_lectura'];

    protected $casts = ['fecha_lectura' => 'date'];

    public function medidor()
    {
        return $this->belongsTo(Medidor::class);
    }
}
