<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'course_progress_id',
        'certificate_code',
        'issued_at',
        'pdf_path',
        'verification_url',
        'notes',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function progress()
    {
        return $this->belongsTo(CourseProgress::class, 'course_progress_id');
    }

    // Helpers
    public function getDownloadUrlAttribute(): ?string
    {
        if (! $this->pdf_path) {
            return null;
        }

        return asset('storage/'.$this->pdf_path);
    }

    public function getVerificationUrlAttribute(): string
    {
        // Example: public verification page
        // return route('certificates.verify', $this->certificate_code);
    }
}
