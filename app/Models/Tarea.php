<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Added this line for HasFactory

class Tarea extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['grupo_id', 'titulo', 'descripcion', 'fecha_limite'];

    protected $casts = [
        'fecha_limite' => 'datetime',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}
