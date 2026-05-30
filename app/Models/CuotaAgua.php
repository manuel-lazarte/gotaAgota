<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuotaAgua extends Model
{
    use HasFactory;

    protected $table = 'cuota_aguas';

    protected $fillable = ['familia_id', 'litros_asignados', 'periodo'];

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }
}
