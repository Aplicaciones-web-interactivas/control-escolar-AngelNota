<?php

namespace App\Filament\Resources\Inscripcions;

use App\Filament\Resources\Inscripcions\Pages\CreateInscripcion;
use App\Filament\Resources\Inscripcions\Pages\EditInscripcion;
use App\Filament\Resources\Inscripcions\Pages\ListInscripcions;
use App\Filament\Resources\Inscripcions\Schemas\InscripcionForm;
use App\Filament\Resources\Inscripcions\Tables\InscripcionsTable;
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
}
