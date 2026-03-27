<?php

namespace App\Filament\Profesor\Resources\Inscripcions\Pages;

use App\Filament\Profesor\Resources\Inscripcions\InscripcionResource;
use Filament\Actions\CreateAction;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Resources\Pages\ListRecords;

class ListInscripcions extends ListRecords
{
    protected static string $resource = InscripcionResource::class;

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
