<?php

namespace App\Filament\Alumno\Resources\Calificacions;

use App\Filament\Alumno\Resources\Calificacions\Pages\CreateCalificacion;
use App\Filament\Alumno\Resources\Calificacions\Pages\EditCalificacion;
use App\Filament\Alumno\Resources\Calificacions\Pages\ListCalificacions;
use App\Filament\Alumno\Resources\Calificacions\Schemas\CalificacionForm;
use App\Filament\Alumno\Resources\Calificacions\Tables\CalificacionsTable;
use App\Models\Calificacion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CalificacionResource extends Resource
{
    protected static ?string $model = Calificacion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CalificacionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CalificacionsTable::configure($table);
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
            'index' => ListCalificacions::route('/'),
            'create' => CreateCalificacion::route('/create'),
            'edit' => EditCalificacion::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function canCreate(): bool { return false; }
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool { return false; }
    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool { return false; }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('inscripcion', fn($q) => $q->where('alumno_id', auth()->id()));
    }
}
