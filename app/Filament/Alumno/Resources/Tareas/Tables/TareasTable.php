<?php

namespace App\Filament\Alumno\Resources\Tareas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TareasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('grupo.materia.name')
                    ->label('Materia')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('grupo.name')
                    ->label('Grupo')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('titulo')
                    ->label('Título de Tarea')
                    ->searchable(),
                TextColumn::make('fecha_limite')
                    ->label('Fecha Límite')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\Action::make('entregar')
                    ->label(fn (\App\Models\Tarea $record) => $record->entregas()->where('alumno_id', auth()->id())->exists() ? 'Actualizar Entrega' : 'Subir Entrega')
                    ->icon(fn (\App\Models\Tarea $record) => $record->entregas()->where('alumno_id', auth()->id())->exists() ? 'heroicon-o-check-circle' : 'heroicon-o-arrow-up-tray')
                    ->color(fn (\App\Models\Tarea $record) => $record->entregas()->where('alumno_id', auth()->id())->exists() ? 'success' : 'primary')
                    ->form(function (\App\Models\Tarea $record) {
                        $entrega = $record->entregas()->where('alumno_id', auth()->id())->first();
                        return [
                            \Filament\Forms\Components\FileUpload::make('archivo_pdf')
                                ->label('Archivo (PDF)')
                                ->acceptedFileTypes(['application/pdf'])
                                ->default($entrega?->archivo_pdf)
                                ->required(),
                        ];
                    })
                    ->action(function (array $data, \App\Models\Tarea $record) {
                        $existing = $record->entregas()->where('alumno_id', auth()->id())->first();
                        if ($existing) {
                            $existing->update(['archivo_pdf' => $data['archivo_pdf']]);
                            \Filament\Notifications\Notification::make()->title('Entrega actualizada')->success()->send();
                        } else {
                            \App\Models\Entrega::create([
                                'tarea_id' => $record->id,
                                'alumno_id' => auth()->id(),
                                'archivo_pdf' => $data['archivo_pdf'],
                            ]);
                            \Filament\Notifications\Notification::make()->title('Tarea entregada con éxito')->success()->send();
                        }
                    }),
            ])
            ->bulkActions([
                // Removed bulk actions for student
            ]);
    }
}
