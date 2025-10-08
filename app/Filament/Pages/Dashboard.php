<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.dashboard';
    
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverviewWidget::class,
            \App\Filament\Widgets\VisitorsChartWidget::class,
            \App\Filament\Widgets\TopPagesWidget::class,
            \App\Filament\Widgets\DeviceStatsWidget::class,
            \App\Filament\Widgets\ClickStatsWidget::class,
            \App\Filament\Widgets\RecentActivityWidget::class,
        ];
    }
    
    public function getColumns(): int | string | array
    {
        return 2;
    }
}