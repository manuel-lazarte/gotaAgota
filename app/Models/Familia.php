<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;

    protected $fillable = ['propiedad_id', 'nombre', 'num_integrantes'];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

    public function cuotas()
    {
        return $this->hasMany(CuotaAgua::class);
    }
}
