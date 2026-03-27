<?php

namespace App\Filament\Profesor\Resources\Calificacions\Pages;

use App\Filament\Profesor\Resources\Calificacions\CalificacionResource;
use Filament\Actions\CreateAction;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Resources\Pages\ListRecords;

class ListCalificacions extends ListRecords
{
    protected static string $resource = CalificacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()->exports([
                ExcelExport::make('table')->fromTable()
            ]),
            CreateAction::make(),
        ];
    }
}
