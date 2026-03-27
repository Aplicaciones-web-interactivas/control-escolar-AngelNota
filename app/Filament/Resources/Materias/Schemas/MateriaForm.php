<?php

namespace App\Filament\Resources\Materias\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MateriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('clave')
                    ->required(),
            ]);
    }
}
