<?php

$files = [
    'Grupos/GrupoResource.php' => "->whereIn('id', \\App\\Models\\Inscripcion::where('alumno_id', auth()->id())->pluck('grupo_id'))",
    'Horarios/HorarioResource.php' => "->whereIn('grupo_id', \\App\\Models\\Inscripcion::where('alumno_id', auth()->id())->pluck('grupo_id'))",
    'Calificacions/CalificacionResource.php' => "->whereHas('inscripcion', fn(\$q) => \$q->where('alumno_id', auth()->id()))",
];

foreach ($files as $path => $query) {
    $fullPath = __DIR__ . '/app/Filament/Alumno/Resources/' . $path;
    $content = file_get_contents($fullPath);
    
    $method = "
    public static function canCreate(): bool { return false; }
    public static function canEdit(\\Illuminate\\Database\\Eloquent\\Model \$record): bool { return false; }
    public static function canDelete(\\Illuminate\\Database\\Eloquent\\Model \$record): bool { return false; }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            $query;
    }";
    
    $content = preg_replace('/}(?=[^}]*$)/', $method . "\n}", $content);
    file_put_contents($fullPath, $content);
    echo "Parchado Alumno Read-Only: $path\n";
}
