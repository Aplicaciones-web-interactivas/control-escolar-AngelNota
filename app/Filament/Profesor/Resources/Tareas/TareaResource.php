<?php

namespace App\Filament\Profesor\Resources\Tareas;

use App\Filament\Profesor\Resources\Tareas\Pages\CreateTarea;
use App\Filament\Profesor\Resources\Tareas\Pages\EditTarea;
use App\Filament\Profesor\Resources\Tareas\Pages\ListTareas;
use App\Filament\Profesor\Resources\Tareas\Schemas\TareaForm;
use App\Filament\Profesor\Resources\Tareas\Tables\TareasTable;
use App\Models\Tarea;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TareaResource extends Resource
{
    protected static ?string $model = Tarea::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TareaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TareasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTareas::route('/'),
            'create' => CreateTarea::route('/create'),
            'edit' => EditTarea::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->whereHas('grupo', fn($q) => $q->where('profesor_id', auth()->id()));
    }
}
