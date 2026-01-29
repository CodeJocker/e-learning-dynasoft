<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        // 'lesson_id',
        'title',
        'description',
        'time_limit_minutes',
        'max_attempts',
        'passing_score',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // Helpers
    public function isPassedByUser($user): bool
    {
        $bestAttempt = $this->attempts()
            ->where('user_id', $user->id)
            ->orderBy('score', 'desc')
            ->first();

        return $bestAttempt && $bestAttempt->score >= $this->passing_score;
    }

    public function remainingAttemptsForUser($user): int
    {
        $attemptCount = $this->attempts()->where('user_id', $user->id)->count();
        return max(0, $this->max_attempts - $attemptCount);
    }
}