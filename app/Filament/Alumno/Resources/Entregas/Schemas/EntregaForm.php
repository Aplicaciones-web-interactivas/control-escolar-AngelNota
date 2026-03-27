<?php
namespace App\Filament\Alumno\Resources\Entregas\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class EntregaForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            Select::make('tarea_id')
                ->relationship('tarea', 'titulo', modifyQueryUsing: fn (Builder $query) => 
                    $query->whereIn('grupo_id', \App\Models\Inscripcion::where('alumno_id', auth()->id())->pluck('grupo_id'))
                )
                ->required()
                ->label('Tarea a Entregar'),
            Hidden::make('alumno_id')->default(fn () => auth()->id()),
            FileUpload::make('archivo_pdf')->acceptedFileTypes(['application/pdf'])->required()->label('Archivo PDF'),
            TextInput::make('calificacion_obtenida')->numeric()->disabled()->default(null)->label('Calificación Obtenida'),
        ]);
    }
}
