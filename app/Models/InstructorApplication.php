<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class InstructorApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'city',
        'whatsapp',
        'email',
        'expertise_fields',
        'diploma_file',
        'other_expertise',
        'cv_path',
        'certificate_paths',
        'availability_time',
        'availability_programs',
        'motivation',
        'status',
        'admin_notes',
        'ip_address',
        'user_agent',
        'usulan_kegiatan_dan_materi',
    ];

    protected $casts = [
        'expertise_fields' => 'array',
        'certificate_paths' => 'array',
        'availability_time' => 'array',
        'availability_programs' => 'array',
    ];

    // Helper untuk status badge
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Unknown',
        };
    }

    // Helper untuk cek file exists
    public function hasCV()
    {
        return !empty($this->cv_path) && Storage::disk('public')->exists($this->cv_path);
    }

    // Helper untuk get CV URL
    public function getCVUrl()
    {
        if ($this->hasCV()) {
            return Storage::url($this->cv_path);
        }
        return null;
    }

    // Scope
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}