<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'training_id',
        'is_working',
        'has_skp',
        'skp_expired_date',
        'work_photo',
        'company_name',
        'job_position',
        'allow_publish_photo',
    ];

    protected $casts = [
        'is_working'          => 'boolean',
        'has_skp'             => 'boolean',
        'skp_expired_date'    => 'date',
        'allow_publish_photo' => 'boolean',
    ];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    /**
     * Cek apakah SKP masih berlaku (belum expired).
     */
    public function isSkpValid(): bool
    {
        if (! $this->has_skp || ! $this->skp_expired_date) {
            return false;
        }

        return $this->skp_expired_date->isFuture();
    }
}
