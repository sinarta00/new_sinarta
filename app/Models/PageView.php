<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_url',
        'page_name',
        'ip_address',
        'user_agent',
        'device_type',
        'referer',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    // Scope untuk hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('visited_at', today());
    }

    // Scope untuk minggu ini
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('visited_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    // Scope untuk bulan ini
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('visited_at', now()->month)
                     ->whereYear('visited_at', now()->year);
    }

    // Scope untuk 7 hari terakhir
    public function scopeLast7Days($query)
    {
        return $query->where('visited_at', '>=', now()->subDays(7));
    }
}