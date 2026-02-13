<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'started_at',
        'finished_at',
        'score',
        'status',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    // Relationships
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }

    // Helpers
    public function calculateScore(): int
    {
        // Logic to sum marks from answers (auto for MCQ)
        return $this->answers->sum('marks_awarded');
    }

    public function isTimedOut(): bool
    {
        $timeLimit = $this->quiz->time_limit_minutes;
        return now()->diffInMinutes($this->started_at) > $timeLimit;
    }
}