<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AntecedenteAlergia extends Model
{
    use HasFactory;

    protected $fillable = [
        'mascota_id',
        'sustancia_alergena',
        'reaccion',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
