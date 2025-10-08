<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'click_type',
        'click_label',
        'page_url',
        'ip_address',
        'clicked_at',
    ];

    protected $casts = [
        'clicked_at' => 'datetime',
    ];

    // Scope untuk hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('clicked_at', today());
    }

    // Scope untuk minggu ini
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('clicked_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }
}