<?php

namespace App\Filament\Widgets;

use App\Models\Alumni;
use App\Models\Training;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AlumniStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalAlumni    = Alumni::count();
        $totalTrainings = Training::count();
        $thisYear       = Training::where('training_year', now()->year)->count();
        $withEmail      = Alumni::whereNotNull('email')->count();
        $emailPercent   = $totalAlumni > 0 ? round(($withEmail / $totalAlumni) * 100) : 0;

        return [
            Stat::make('Total Alumni', number_format($totalAlumni))
                ->description('Alumni terdaftar')->descriptionIcon('heroicon-m-users')->color('primary'),

            Stat::make('Total Pelatihan', number_format($totalTrainings))
                ->description('Program pelatihan')->descriptionIcon('heroicon-m-academic-cap')->color('success'),

            Stat::make('Pelatihan ' . now()->year, $thisYear)
                ->description('Program tahun ini')->descriptionIcon('heroicon-m-calendar')->color('info'),

            Stat::make('Punya Email', "{$emailPercent}%")
                ->description("{$withEmail} dari {$totalAlumni} alumni")->descriptionIcon('heroicon-m-envelope')->color('warning'),
        ];
    }
}
