<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramSchedule extends Model
{
    protected $fillable = [
        'program_id',
        'start_date',
        'end_date',
        'city',
        'location',
        'quota',
        'registered',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_active'  => 'boolean',
    ];

    protected $appends = ['status', 'available_slots'];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    // "Tersedia" atau "Penuh"
    public function getStatusAttribute(): string
    {
        return $this->registered >= $this->quota ? 'Penuh' : 'Tersedia';
    }

    // Sisa slot tersedia
    public function getAvailableSlotsAttribute(): int
    {
        return max(0, $this->quota - $this->registered);
    }

    // Scope: jadwal mendatang yang aktif
    public function scopeUpcoming($query)
    {
        return $query->where('is_active', true)
                     ->where('start_date', '>=', now()->toDateString())
                     ->orderBy('start_date', 'asc');
    }
}