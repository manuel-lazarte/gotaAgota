<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanqueComunitario extends Model
{
    use HasFactory;

    protected $fillable = ['capacidad_total', 'nivel_actual', 'fecha_registro'];

    protected $casts = ['fecha_registro' => 'datetime'];
}
