<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tratamiento extends Model
{
    use HasFactory;

    protected $table = 'tratamientos';

    protected $fillable = [
        'mascota_id',
        'medicamento',
        'dosis',
        'frecuencia',
        'fecha_inicio',
        'fecha_fin',
        'indicaciones',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
