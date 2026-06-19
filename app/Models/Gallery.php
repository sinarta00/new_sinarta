<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'category',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    // -------------------------------------------------------
    // Scopes
    // -------------------------------------------------------

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('created_at');
    }

    // -------------------------------------------------------
    // Accessor
    // -------------------------------------------------------

    /**
     * Otomatis deteksi jenis path:
     * - Diawali "images/" atau "/"  → asset dari public/ (foto statis/seeder)
     * - Lainnya (cth: "gallery/xxx.jpg") → file dari storage/app/public/
     */
    public function getImageUrlAttribute(): string
    {
        if (
            str_starts_with($this->image_path, 'images/') ||
            str_starts_with($this->image_path, '/')
        ) {
            return asset($this->image_path);
        }

        return Storage::url($this->image_path);
    }
}