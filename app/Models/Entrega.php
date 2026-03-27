<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Assuming HasFactory is needed, it's common with SoftDeletes

class Entrega extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['tarea_id', 'alumno_id', 'archivo_pdf', 'calificacion_obtenida'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }
}
