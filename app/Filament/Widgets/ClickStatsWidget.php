<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PageClick;
use Illuminate\Support\Facades\DB;

class ClickStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Klik Berdasarkan Tipe (7 Hari)';
    protected static ?int $sort = 6;

    protected function getData(): array
    {
        $clicks = PageClick::select('click_type', DB::raw('COUNT(*) as count'))
            ->where('clicked_at', '>=', now()->subDays(7))
            ->groupBy('click_type')
            ->get();

        $labels = [];
        $data = [];

        foreach ($clicks as $click) {
            $labels[] = ucfirst($click->click_type);
            $data[] = $click->count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Klik',
                    'data' => $data,
                    'backgroundColor' => [
                        '#10b981', // Green - WhatsApp
                        '#800020', // Maroon - Program
                        '#3b82f6', // Blue - Service
                        '#f59e0b', // Orange - Other
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}