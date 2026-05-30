<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'cedula', 'email', 'activo'];

    protected $casts = ['activo' => 'boolean'];

    public function telefonos()
    {
        return $this->hasMany(TelefonoSocio::class);
    }

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
