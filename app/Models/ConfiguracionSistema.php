<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConfiguracionSistema extends Model
{
    use HasFactory;

    protected $table = 'configuracion_sistema';

    protected $fillable = [
        'nombre_clinica',
        'mision',
        'vision',
        'valores',
        'historia',
        'precios_servicios',
        'direccion_fisica',
        'telefono_contacto',
        'logo_path',
    ];

    protected $casts = [
        'precios_servicios' => 'array',
    ];
}
