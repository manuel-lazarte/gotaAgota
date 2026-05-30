<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoSocio extends Model
{
    use HasFactory;

    protected $fillable = ['socio_id', 'numero', 'es_principal'];

    protected $casts = ['es_principal' => 'boolean'];

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }
}
