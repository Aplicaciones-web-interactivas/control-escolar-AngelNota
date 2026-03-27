<?php

$dir = new RecursiveDirectoryIterator(__DIR__ . '/app/Filament/Resources');
$iterator = new RecursiveIteratorIterator($dir);

foreach ($iterator as $file) {
    if ($file->isFile() && str_starts_with($file->getFilename(), 'List') && str_ends_with($file->getFilename(), '.php')) {
        $content = file_get_contents($file->getPathname());

        // Solo inyectar si no está inyectado ya
        if (strpos($content, 'pxlrbt\\FilamentExcel') === false) {
            
            // Reemplazar la definición de namespace y uses
            $newImports = "\nuse pxlrbt\\FilamentExcel\\Actions\\Pages\\ExportAction;\nuse pxlrbt\\FilamentExcel\\Exports\\ExcelExport;";
            $content = preg_replace('/use Filament\\\\Actions\\\\CreateAction;/', "use Filament\\Actions\\CreateAction;{$newImports}", $content);

            // Reemplazar el retorno de getHeaderActions
            $replacement = "return [\n            ExportAction::make()->exports([\n                ExcelExport::make('table')->fromTable()\n            ]),\n            CreateAction::make(),\n        ];";
            
            $content = preg_replace('/return\s*\[\s*CreateAction::make\(\),\s*\];/', $replacement, $content);

            file_put_contents($file->getPathname(), $content);
            echo "Añadida exportación a: " . $file->getFilename() . "\n";
        }
    }
}
