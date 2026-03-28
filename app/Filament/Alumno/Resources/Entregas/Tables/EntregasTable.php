<?php

namespace App\Filament\Alumno\Resources\Entregas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class EntregasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tarea.titulo')
                    ->label('Tarea')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('archivo_pdf')
                    ->label('Archivo Entregado')
                    ->searchable(),
                TextColumn::make('calificacion_obtenida')
                    ->label('Calificación'),
                TextColumn::make('created_at')
                    ->label('Fecha de Entrega')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                \Filament\Actions\ViewAction::make(),
            ])
            ->bulkActions([
            ]);
    }
}
