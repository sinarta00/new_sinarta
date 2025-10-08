<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\PageView;
use Illuminate\Support\Facades\DB;

class TopPagesWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        // Get data langsung dengan Collection, bukan Query Builder
        $topPages = DB::table('page_views')
            ->select('page_name', DB::raw('COUNT(*) as views'))
            ->where('visited_at', '>=', now()->subDays(7))
            ->whereNotNull('page_name')
            ->groupBy('page_name')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();

        return $table
            ->heading('Halaman Paling Banyak Dikunjungi (7 Hari Terakhir)')
            ->query(
                // Pakai query kosong, data diambil manual di getTableRecords()
                fn () => PageView::query()->whereRaw('1 = 0')
            )
            ->columns([
                Tables\Columns\TextColumn::make('page_name')
                    ->label('Halaman')
                    ->icon('heroicon-m-document-text')
                    ->color('primary')
                    ->weight('bold')
                    ->sortable(false),
                
                Tables\Columns\TextColumn::make('views')
                    ->label('Jumlah Kunjungan')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($state) => number_format($state) . ' views')
                    ->sortable(false),
                
                Tables\Columns\TextColumn::make('percentage')
                    ->label('Persentase')
                    ->state(function ($record) {
                        $total = PageView::where('visited_at', '>=', now()->subDays(7))->count();
                        if ($total > 0) {
                            return round(($record->views / $total) * 100, 1) . '%';
                        }
                        return '0%';
                    })
                    ->badge()
                    ->color('info')
                    ->sortable(false),
            ])
            ->paginated(false);
    }

    // Override method ini untuk inject data manual
    protected function paginateTableQuery(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Contracts\Pagination\Paginator
    {
        $topPages = DB::table('page_views')
            ->select('page_name', DB::raw('COUNT(*) as views'))
            ->where('visited_at', '>=', now()->subDays(7))
            ->whereNotNull('page_name')
            ->groupBy('page_name')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $topPages,
            $topPages->count(),
            $topPages->count()
        );
    }
}