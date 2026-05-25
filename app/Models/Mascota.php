<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = [
        'dueno_id',
        'nombre',
        'especie',
        'raza',
        'fecha_nacimiento',
        'tipo_sangre',
        'comportamiento',
        'es_adoptado',
    ];

    public function dueno()
    {
        return $this->belongsTo(Dueno::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function antecedentesAlergias()
    {
        return $this->hasMany(AntecedenteAlergia::class);
    }

    public function antecedentesLesiones()
    {
        return $this->hasMany(AntecedenteLesion::class);
    }

    public function antecedentesPatologicos()
    {
        return $this->hasMany(AntecedentePatologico::class);
    }

    public function historialAlimentacion()
    {
        return $this->hasMany(HistorialAlimentacion::class);
    }

    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class);
    }
}
