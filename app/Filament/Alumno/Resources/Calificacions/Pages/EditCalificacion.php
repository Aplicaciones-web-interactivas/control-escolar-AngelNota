<?php

namespace App\Filament\Alumno\Resources\Calificacions\Pages;

use App\Filament\Alumno\Resources\Calificacions\CalificacionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditCalificacion extends EditRecord
{
    protected static string $resource = CalificacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
