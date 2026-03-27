<?php

$files = [
    'Grupos/GrupoResource.php' => "->where('profesor_id', auth()->id())",
    'Horarios/HorarioResource.php' => "->whereHas('grupo', fn(\$q) => \$q->where('profesor_id', auth()->id()))",
    'Inscripcions/InscripcionResource.php' => "->whereHas('grupo', fn(\$q) => \$q->where('profesor_id', auth()->id()))",
    'Calificacions/CalificacionResource.php' => "->whereHas('inscripcion.grupo', fn(\$q) => \$q->where('profesor_id', auth()->id()))",
];

foreach ($files as $path => $query) {
    $fullPath = __DIR__ . '/app/Filament/Profesor/Resources/' . $path;
    $content = file_get_contents($fullPath);
    
    $method = "
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            $query;
    }";
    
    // Inyectar antes de la última llave de cierre
    $content = preg_replace('/}(?=[^}]*$)/', $method . "\n}", $content);
    file_put_contents($fullPath, $content);
    echo "Parchado: $path\n";
}
