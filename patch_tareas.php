<?php

// 1. Tarea Form (Profesor)
$file = __DIR__ . '/app/Filament/Profesor/Resources/Tareas/Schemas/TareaForm.php';
$content = "<?php
namespace App\Filament\Profesor\Resources\Tareas\Schemas;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class TareaForm {
    public static function configure(Schema \$schema): Schema {
        return \$schema->components([
            Select::make('grupo_id')
                ->relationship('grupo', 'name', modifyQueryUsing: fn (Builder \$query) => \$query->where('profesor_id', auth()->id()))
                ->label('Grupo Asignado')
                ->required(),
            TextInput::make('titulo')->required(),
            Textarea::make('descripcion')->required()->columnSpanFull(),
            DateTimePicker::make('fecha_limite'),
        ]);
    }
}
";
file_put_contents($file, $content);

// 2. Entrega Form (Profesor)
$file = __DIR__ . '/app/Filament/Profesor/Resources/Entregas/Schemas/EntregaForm.php';
$content = "<?php
namespace App\Filament\Profesor\Resources\Entregas\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class EntregaForm {
    public static function configure(Schema \$schema): Schema {
        return \$schema->components([
            Select::make('tarea_id')->relationship('tarea', 'titulo')->disabled(),
            Select::make('alumno_id')->relationship('alumno', 'name')->disabled(),
            FileUpload::make('archivo_pdf')->acceptedFileTypes(['application/pdf'])->downloadable()->disabled()->label('Comprobante PDF'),
            TextInput::make('calificacion_obtenida')->numeric()->default(null)->label('Calificación Asignada'),
        ]);
    }
}
";
file_put_contents($file, $content);

// 3. Entrega Form (Alumno)
$file = __DIR__ . '/app/Filament/Alumno/Resources/Entregas/Schemas/EntregaForm.php';
$content = "<?php
namespace App\Filament\Alumno\Resources\Entregas\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class EntregaForm {
    public static function configure(Schema \$schema): Schema {
        return \$schema->components([
            Select::make('tarea_id')
                ->relationship('tarea', 'titulo', modifyQueryUsing: fn (Builder \$query) => 
                    \$query->whereIn('grupo_id', \App\Models\Inscripcion::where('alumno_id', auth()->id())->pluck('grupo_id'))
                )
                ->required()
                ->label('Tarea a Entregar'),
            Hidden::make('alumno_id')->default(fn () => auth()->id()),
            FileUpload::make('archivo_pdf')->acceptedFileTypes(['application/pdf'])->required()->label('Archivo PDF'),
            TextInput::make('calificacion_obtenida')->numeric()->disabled()->default(null)->label('Calificación Obtenida'),
        ]);
    }
}
";
file_put_contents($file, $content);


// 4. Scopes para Profesor
$filesProfesor = [
    'Tareas/TareaResource.php' => "->whereHas('grupo', fn(\$q) => \$q->where('profesor_id', auth()->id()))",
    'Entregas/EntregaResource.php' => "->whereHas('tarea.grupo', fn(\$q) => \$q->where('profesor_id', auth()->id()))",
];
foreach ($filesProfesor as $path => $query) {
    $fullPath = __DIR__ . '/app/Filament/Profesor/Resources/' . $path;
    $content = file_get_contents($fullPath);
    
    // Si ya existe el getEloquentQuery, lo evitamos
    if (strpos($content, 'getEloquentQuery()') === false) {
        $method = "
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()" . $query . ";
    }";
        $content = preg_replace('/}(?=[^}]*$)/', $method . "\n}", $content);
        file_put_contents($fullPath, $content);
    }
}


// 5. Scopes para Alumno
$filesAlumno = [
    'Tareas/TareaResource.php' => "->whereIn('grupo_id', \App\Models\Inscripcion::where('alumno_id', auth()->id())->pluck('grupo_id'))",
    'Entregas/EntregaResource.php' => "->where('alumno_id', auth()->id())",
];
foreach ($filesAlumno as $path => $query) {
    $fullPath = __DIR__ . '/app/Filament/Alumno/Resources/' . $path;
    $content = file_get_contents($fullPath);
    
    $readOnlyLogic = ($path === 'Tareas/TareaResource.php') ? "
    public static function canCreate(): bool { return false; }
    public static function canEdit(\Illuminate\Database\Eloquent\Model \$record): bool { return false; }
    public static function canDelete(\Illuminate\Database\Eloquent\Model \$record): bool { return false; }
" : "";

    if (strpos($content, 'getEloquentQuery()') === false) {
        $method = $readOnlyLogic . "
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()" . $query . ";
    }";
        $content = preg_replace('/}(?=[^}]*$)/', $method . "\n}", $content);
        file_put_contents($fullPath, $content);
    }
}

echo "Parche finalizado sin errores.\n";
