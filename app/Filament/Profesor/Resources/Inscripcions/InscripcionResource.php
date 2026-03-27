<?php

namespace App\Filament\Profesor\Resources\Inscripcions;

use App\Filament\Profesor\Resources\Inscripcions\Pages\CreateInscripcion;
use App\Filament\Profesor\Resources\Inscripcions\Pages\EditInscripcion;
use App\Filament\Profesor\Resources\Inscripcions\Pages\ListInscripcions;
use App\Filament\Profesor\Resources\Inscripcions\Schemas\InscripcionForm;
use App\Filament\Profesor\Resources\Inscripcions\Tables\InscripcionsTable;
use App\Models\Inscripcion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InscripcionResource extends Resource
{
    protected static ?string $model = Inscripcion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return InscripcionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InscripcionsTable::configure($table);
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
            'index' => ListInscripcions::route('/'),
            'create' => CreateInscripcion::route('/create'),
            'edit' => EditInscripcion::route('/{record}/edit'),
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
}
