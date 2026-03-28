<?php

namespace App\Filament\Profesor\Resources\Calificacions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CalificacionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('inscripcion_id')
                    ->label('Inscripción (Alumno - Materia/Grupo)')
                    ->relationship('inscripcion', 'id')
                    ->getOptionLabelFromRecordUsing(fn (\App\Models\Inscripcion $record) => "{$record->alumno->name} - {$record->grupo->materia->name} ({$record->grupo->name})")
                    ->searchable()
                    ->preload()
                    ->required(),
                \Filament\Forms\Components\TextInput::make('calificacion')
                    ->label('Calificación')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('tipo_evaluacion')
                    ->label('Tipo de Evaluación')
                    ->required(),
            ]);
    }
}
