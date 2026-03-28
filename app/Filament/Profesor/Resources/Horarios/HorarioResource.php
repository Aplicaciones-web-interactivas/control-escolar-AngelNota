<?php

namespace App\Filament\Profesor\Resources\Horarios;

use App\Filament\Profesor\Resources\Horarios\Pages\CreateHorario;
use App\Filament\Profesor\Resources\Horarios\Pages\EditHorario;
use App\Filament\Profesor\Resources\Horarios\Pages\ListHorarios;
use App\Filament\Profesor\Resources\Horarios\Schemas\HorarioForm;
use App\Filament\Profesor\Resources\Horarios\Tables\HorariosTable;
use App\Models\Horario;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HorarioResource extends Resource
{
    protected static ?string $model = Horario::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HorarioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HorariosTable::configure($table);
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
            'index' => ListHorarios::route('/'),
            'create' => CreateHorario::route('/create'),
            'edit' => EditHorario::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('grupo', fn($q) => $q->where('profesor_id', auth()->id()));
    }

    public static function canCreate(): bool { return false; }
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool { return false; }
    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool { return false; }
}
