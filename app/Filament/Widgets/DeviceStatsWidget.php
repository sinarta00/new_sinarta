<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PageView;
use Illuminate\Support\Facades\DB;

class DeviceStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Pengunjung Berdasarkan Device';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $devices = PageView::select('device_type', DB::raw('COUNT(*) as count'))
            ->where('visited_at', '>=', now()->subDays(7))
            ->groupBy('device_type')
            ->get();

        $labels = [];
        $data = [];
        $colors = [
            'mobile' => '#10b981',    // Green
            'desktop' => '#3b82f6',   // Blue
            'tablet' => '#f59e0b',    // Orange
        ];
        $bgColors = [];

        foreach ($devices as $device) {
            $deviceName = ucfirst($device->device_type ?? 'Unknown');
            $labels[] = $deviceName;
            $data[] = $device->count;
            $bgColors[] = $colors[$device->device_type] ?? '#6b7280';
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengunjung',
                    'data' => $data,
                    'backgroundColor' => $bgColors,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}