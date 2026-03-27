<?php

namespace App\Filament\Alumno\Resources\Grupos;

use App\Filament\Alumno\Resources\Grupos\Pages\CreateGrupo;
use App\Filament\Alumno\Resources\Grupos\Pages\EditGrupo;
use App\Filament\Alumno\Resources\Grupos\Pages\ListGrupos;
use App\Filament\Alumno\Resources\Grupos\Schemas\GrupoForm;
use App\Filament\Alumno\Resources\Grupos\Tables\GruposTable;
use App\Models\Grupo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GrupoResource extends Resource
{
    protected static ?string $model = Grupo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return GrupoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GruposTable::configure($table);
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
            'index' => ListGrupos::route('/'),
            'create' => CreateGrupo::route('/create'),
            'edit' => EditGrupo::route('/{record}/edit'),
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
            ->whereIn('id', \App\Models\Inscripcion::where('alumno_id', auth()->id())->pluck('grupo_id'));
    }
}
