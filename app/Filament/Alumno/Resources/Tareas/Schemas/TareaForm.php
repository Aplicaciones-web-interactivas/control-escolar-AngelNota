<?php

namespace App\Filament\Alumno\Resources\Tareas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TareaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('grupo_id')
                    ->required()
                    ,
                TextInput::make('titulo')
                    ->required(),
                Textarea::make('descripcion')
                    ->required()
                    ->columnSpanFull(),
                DateTimePicker::make('fecha_limite'),
            ]);
    }
}
