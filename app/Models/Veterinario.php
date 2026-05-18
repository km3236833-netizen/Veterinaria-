<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Veterinario extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'nombre_completo',
        'especialidad',
        'cedula_profesional',
        'foto_firma',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
}
