<?php

namespace App\Models;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id', 'name', 'price', 'discount',
        'registration_link', 'duration', 'is_active', 'order'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
