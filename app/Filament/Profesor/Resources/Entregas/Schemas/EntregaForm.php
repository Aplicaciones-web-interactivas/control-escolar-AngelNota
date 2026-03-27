<?php
namespace App\Filament\Profesor\Resources\Entregas\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class EntregaForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            Select::make('tarea_id')->relationship('tarea', 'titulo')->disabled(),
            Select::make('alumno_id')->relationship('alumno', 'name')->disabled(),
            FileUpload::make('archivo_pdf')->acceptedFileTypes(['application/pdf'])->downloadable()->disabled()->label('Comprobante PDF'),
            TextInput::make('calificacion_obtenida')->numeric()->default(null)->label('Calificación Asignada'),
        ]);
    }
}
