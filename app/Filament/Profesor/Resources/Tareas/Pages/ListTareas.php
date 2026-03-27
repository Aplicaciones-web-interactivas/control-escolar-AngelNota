<?php

namespace App\Filament\Profesor\Resources\Tareas\Pages;

use App\Filament\Profesor\Resources\Tareas\TareaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTareas extends ListRecords
{
    protected static string $resource = TareaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
