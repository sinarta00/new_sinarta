<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'features',
        'duration',
        'price',
        'discount',
        'image',
        'registration_link',
        'category',
        'is_active',
        'order',
        'pdf_file'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function getFinalPriceAttribute()
    {
        if (!$this->discount || !$this->price) {
            return $this->price;
        }

        return $this->price - ($this->price * $this->discount / 100);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(ProgramSchedule::class, 'program_id');
    }

    public function nearestSchedules(): HasMany
    {
        return $this->hasMany(ProgramSchedule::class, 'program_id')
                    ->upcoming()
                    ->limit(3);
    }

}