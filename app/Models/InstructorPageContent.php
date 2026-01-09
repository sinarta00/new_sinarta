<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorPageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key',
        'content',
        'is_active',
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    // Helper untuk get content by section
    public static function getContent($sectionKey)
    {
        $section = self::where('section_key', $sectionKey)
                       ->where('is_active', true)
                       ->first();
        
        return $section ? $section->content : null;
    }
}