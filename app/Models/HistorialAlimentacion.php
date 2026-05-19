<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistorialAlimentacion extends Model
{
    use HasFactory;

    protected $table = 'historial_alimentacion';

    protected $fillable = [
        'mascota_id',
        'descripcion_dieta',
        'frecuencia_diaria',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
