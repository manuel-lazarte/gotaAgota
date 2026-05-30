<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidor extends Model
{
    use HasFactory;

    protected $fillable = ['propiedad_id', 'numero_serie', 'fecha_instalacion', 'activo'];

    protected $casts = [
        'activo'            => 'boolean',
        'fecha_instalacion' => 'date',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

    public function consumos()
    {
        return $this->hasMany(Consumo::class);
    }
}
