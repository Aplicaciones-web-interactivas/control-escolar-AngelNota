<?php

namespace App\Filament\Profesor\Resources\Entregas;

use App\Filament\Profesor\Resources\Entregas\Pages\CreateEntrega;
use App\Filament\Profesor\Resources\Entregas\Pages\EditEntrega;
use App\Filament\Profesor\Resources\Entregas\Pages\ListEntregas;
use App\Filament\Profesor\Resources\Entregas\Schemas\EntregaForm;
use App\Filament\Profesor\Resources\Entregas\Tables\EntregasTable;
use App\Models\Entrega;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntregaResource extends Resource
{
    protected static ?string $model = Entrega::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return EntregaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EntregasTable::configure($table);
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
            'index' => ListEntregas::route('/'),
            'create' => CreateEntrega::route('/create'),
            'edit' => EditEntrega::route('/{record}/edit'),
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
        return parent::getEloquentQuery()->whereHas('tarea.grupo', fn($q) => $q->where('profesor_id', auth()->id()));
    }
}
