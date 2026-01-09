<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'open_new_tab',
        'start_date',
        'end_date',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_new_tab' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Check apakah popup valid untuk ditampilkan
    public function isValid()
    {
        $now = Carbon::now();
        
        if (!$this->is_active) {
            return false;
        }
        
        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }
        
        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }
        
        return true;
    }

    // Scope untuk popup yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where(function($q) {
                         $q->whereNull('start_date')
                           ->orWhere('start_date', '<=', Carbon::now());
                     })
                     ->where(function($q) {
                         $q->whereNull('end_date')
                           ->orWhere('end_date', '>=', Carbon::now());
                     });
    }
}