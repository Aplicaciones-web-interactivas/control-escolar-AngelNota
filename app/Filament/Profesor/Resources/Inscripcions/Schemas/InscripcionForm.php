<?php

namespace App\Filament\Profesor\Resources\Inscripcions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InscripcionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('grupo_id')
                    ->label('Grupo')
                    ->relationship('grupo', 'name')
                    ->getOptionLabelFromRecordUsing(fn (\App\Models\Grupo $record) => "{$record->materia->name} ({$record->name})")
                    ->searchable()
                    ->preload()
                    ->required(),
                \Filament\Forms\Components\Select::make('alumno_id')
                    ->label('Alumno')
                    ->relationship('alumno', 'name', fn (\Illuminate\Database\Eloquent\Builder $query) => $query->whereHas('rol', fn ($q) => $q->where('name', 'Alumno')))
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
