<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\PageView;

class RecentActivityWidget extends BaseWidget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Aktivitas Terbaru')
            ->query(
                PageView::query()
                    ->latest('visited_at')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('page_name')
                    ->label('Halaman')
                    ->icon('heroicon-m-document')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'Home' => 'success',
                        'Program' => 'info',
                        'Kontak' => 'warning',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('device_type')
                    ->label('Device')
                    ->icon(fn ($state) => match($state) {
                        'mobile' => 'heroicon-m-device-phone-mobile',
                        'desktop' => 'heroicon-m-computer-desktop',
                        'tablet' => 'heroicon-m-device-tablet',
                        default => 'heroicon-m-question-mark-circle',
                    })
                    ->Color(fn ($state) => match($state) {
                        'mobile' => 'success',
                        'desktop' => 'info',
                        'tablet' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state ?? 'Unknown')),
                
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable()
                    ->copyable()
                    ->copyMessage('IP copied!')
                    ->icon('heroicon-m-globe-alt'),
                
                Tables\Columns\TextColumn::make('visited_at')
                    ->label('Waktu')
                    ->dateTime('d M Y, H:i')
                    ->since()
                    ->description(fn ($record) => $record->visited_at->diffForHumans())
                    ->sortable(),
            ])
            ->defaultSort('visited_at', 'desc')
            ->paginated(false);
    }
}