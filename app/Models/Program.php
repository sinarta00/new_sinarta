<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}