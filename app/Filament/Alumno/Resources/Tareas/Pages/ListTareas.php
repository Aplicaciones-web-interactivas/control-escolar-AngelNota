<?php

namespace App\Filament\Alumno\Resources\Tareas\Pages;

use App\Filament\Alumno\Resources\Tareas\TareaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTareas extends ListRecords
{
    protected static string $resource = TareaResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
