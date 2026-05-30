<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'mensaje', 'activa'];

    protected $casts = ['activa' => 'boolean'];
}
