<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

#[Fillable(['name', 'last_name', 'clave_institucional', 'email', 'password', 'rol_id', 'active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'profesor_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'alumno_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->rol && $this->rol->name === 'Administrador';
        }

        if ($panel->getId() === 'profesor') {
            return $this->rol && ($this->rol->name === 'Profesor' || $this->rol->name === 'Administrador');
        }

        return true;
    }
}
