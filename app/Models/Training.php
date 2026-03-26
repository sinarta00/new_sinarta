<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_name',
        'batch',
        'training_year',
        'organizer',
    ];

    protected $casts = [
        'training_year' => 'integer',
    ];

    public function alumni(): HasMany
    {
        return $this->hasMany(Alumni::class);
    }
}
