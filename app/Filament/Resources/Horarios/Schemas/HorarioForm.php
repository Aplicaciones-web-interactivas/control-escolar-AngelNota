<?php

namespace App\Filament\Resources\Horarios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class HorarioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('grupo_id')
                    ->required()
                    ,
                TextInput::make('dia')
                    ->required(),
                TimePicker::make('hora_inicio')
                    ->required(),
                TimePicker::make('hora_fin')
                    ->required(),
            ]);
    }
}
