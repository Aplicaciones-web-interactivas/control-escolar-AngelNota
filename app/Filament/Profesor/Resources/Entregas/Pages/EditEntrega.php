<?php

namespace App\Filament\Profesor\Resources\Entregas\Pages;

use App\Filament\Profesor\Resources\Entregas\EntregaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditEntrega extends EditRecord
{
    protected static string $resource = EntregaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
