<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscripcion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['grupo_id', 'alumno_id'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'inscripcion_id');
    }
}
