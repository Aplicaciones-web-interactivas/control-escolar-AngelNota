<?php
namespace App\Filament\Profesor\Resources\Tareas\Schemas;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class TareaForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            Select::make('grupo_id')
                ->relationship('grupo', 'name', modifyQueryUsing: fn (Builder $query) => $query->where('profesor_id', auth()->id()))
                ->label('Grupo Asignado')
                ->required(),
            TextInput::make('titulo')->required(),
            Textarea::make('descripcion')->required()->columnSpanFull(),
            DateTimePicker::make('fecha_limite'),
        ]);
    }
}
