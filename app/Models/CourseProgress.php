<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'percent_completed',
        'lessons_completed_count',
        'quizzes_completed_count',
        'is_completed',
        'completed_at',
    ];

    protected $casts = [
        'percent_completed' => 'decimal:2',
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
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

    // Helpers
    public function markAsCompleted(): void
    {
        $this->update([
            'is_completed' => true,
            'percent_completed' => 100.00,
            'completed_at' => now(),
        ]);
    }

    public function isEligibleForCertificate(): bool
    {
        return $this->is_completed;
        // Later you can make this check against certificate_rules
    }
}
