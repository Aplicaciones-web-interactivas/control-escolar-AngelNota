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
                TextInput::make('grupo_id')
                    ->required()
                    ,
                TextInput::make('alumno_id')
                    ->required()
                    ,
            ]);
    }
}
