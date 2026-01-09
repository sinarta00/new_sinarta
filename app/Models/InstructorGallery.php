<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class InstructorGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'alt_text',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    // Scope untuk get active images
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // Helper untuk get image URL
    public function getImageUrlAttribute()
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return Storage::url($this->image_path);
        }
        return null;
    }

    // Helper untuk check image exists
    public function hasImage()
    {
        return !empty($this->image_path) && Storage::disk('public')->exists($this->image_path);
    }

    // Delete image when model is deleted
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($gallery) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
        });
    }
}