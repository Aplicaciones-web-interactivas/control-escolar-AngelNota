<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Materia;
use App\Models\Grupo;
use App\Models\Inscripcion;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Usuarios Registrados', User::count())
                ->description('Total de cuentas activas')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),
            
            Stat::make('Materias', Materia::count())
                ->description('Asignaturas dadas de alta')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary'),
            
            Stat::make('Grupos', Grupo::count())
                ->description('Grupos armados para el ciclo')
                ->descriptionIcon('heroicon-m-rectangle-group')
                ->color('warning'),

            Stat::make('Inscripciones', Inscripcion::count())
                ->description('Alumnos con grupo asignado')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),
        ];
    }
}
