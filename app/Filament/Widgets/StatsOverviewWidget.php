<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\PageView;
use App\Models\PageClick;
use App\Models\ContactMessage;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Today's stats
        $visitorsToday = PageView::today()->count();
        $visitorsYesterday = PageView::whereDate('visited_at', today()->subDay())->count();
        $visitorsDiff = $visitorsToday - $visitorsYesterday;
        $visitorsPercent = $visitorsYesterday > 0 ? round(($visitorsDiff / $visitorsYesterday) * 100) : 0;

        // This week
        $visitorsWeek = PageView::thisWeek()->count();
        
        // Messages today
        $messagesToday = ContactMessage::whereDate('created_at', today())->count();
        $messagesUnread = ContactMessage::where('is_read', false)->count();
        
        // WhatsApp clicks
        $waClicksToday = PageClick::today()->where('click_type', 'whatsapp')->count();

        return [
            Stat::make('Pengunjung Hari Ini', $visitorsToday)
                ->description($visitorsPercent >= 0 ? "+{$visitorsPercent}% dari kemarin" : "{$visitorsPercent}% dari kemarin")
                ->descriptionIcon($visitorsPercent >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($visitorsPercent >= 0 ? 'success' : 'danger')
                ->chart([7, 12, 8, 15, 10, 18, $visitorsToday]),

            Stat::make('Pengunjung Minggu Ini', $visitorsWeek)
                ->description('Total kunjungan 7 hari terakhir')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),

            Stat::make('Pesan Kontak', $messagesToday . ' hari ini')
                ->description($messagesUnread > 0 ? "{$messagesUnread} belum dibaca" : 'Semua sudah dibaca')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($messagesUnread > 0 ? 'warning' : 'success'),

            Stat::make('Klik WhatsApp', $waClicksToday)
                ->description('Total hari ini')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('success'),
        ];
    }
}