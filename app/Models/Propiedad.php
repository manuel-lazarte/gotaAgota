<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $fillable = ['socio_id', 'descripcion', 'direccion', 'estado'];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function familias()
    {
        return $this->hasMany(Familia::class);
    }

    public function medidores()
    {
        return $this->hasMany(Medidor::class);
    }
}
