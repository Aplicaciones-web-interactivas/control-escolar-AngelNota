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
                TextInput::make('inscripcion_id')
                    ->required()
                    ,
                TextInput::make('calificacion')
                    ->required()
                    ,
                TextInput::make('tipo_evaluacion')
                    ->required(),
            ]);
    }
}
