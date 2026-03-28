<?php

namespace App\Filament\Profesor\Resources\Grupos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GrupoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('materia_id')
                    ->required()
                    ,
                TextInput::make('profesor_id')
                    ->required()
                    ,
            ]);
    }
}
