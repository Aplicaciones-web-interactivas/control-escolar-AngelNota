<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calificacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['inscripcion_id', 'calificacion', 'tipo_evaluacion'];

    protected $casts = [
        'calificacion' => 'decimal:2',
    ];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'inscripcion_id');
    }
}
