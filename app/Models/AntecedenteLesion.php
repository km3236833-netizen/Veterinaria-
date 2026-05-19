<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AntecedenteLesion extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_lesiones';

    protected $fillable = [
        'mascota_id',
        'tipo_lesion',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
