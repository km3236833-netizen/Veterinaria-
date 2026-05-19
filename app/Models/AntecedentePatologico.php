<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AntecedentePatologico extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_patologicos';

    protected $fillable = [
        'mascota_id',
        'enfermedad',
        'es_cronica',
    ];

    protected $casts = [
        'es_cronica' => 'boolean',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
