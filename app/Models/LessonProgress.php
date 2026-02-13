<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'completed_at',
        'started_at',
        'time_spent_seconds',
        'is_completed',
    ];

    protected $casts = [
        'completed_at'      => 'datetime',
        'started_at'        => 'datetime',
        'is_completed'      => 'boolean',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // -------------------------------------------------------------------------
    // Helpers / Business logic
    // -------------------------------------------------------------------------

    public function markAsStarted(): void
    {
        if (!$this->started_at) {
            $this->update(['started_at' => now()]);
        }
    }

    public function markAsCompleted(): void
    {
        $this->update([
            'is_completed'  => true,
            'completed_at'  => now(),
        ]);
    }

    public function isCompleted(): bool
    {
        return $this->is_completed || $this->completed_at !== null;
    }
}