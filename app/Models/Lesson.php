<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'title',
        'order',
        'type',
        'content',
        'video_url',
        'document_path',
        'duration_minutes',
    ];


    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    /**
     * The course this lesson belongs to
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * All resources attached to this lesson (PDFs, videos, links, etc.)
     */
    public function resources()
    {
        return $this->hasMany(LessonResource::class)
                    ->orderBy('display_order');
    }

    /**
     * All progress records for this lesson (one per student)
     */
    public function progress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    // -------------------------------------------------------------------------
    // Helper relationship methods (very useful in controllers/views)
    // -------------------------------------------------------------------------

    /**
     * Get the progress record for a specific user (student)
     */
    public function progressForUser($user)
    {
        return $this->progress()
                    ->where('user_id', $user->id)
                    ->first();
    }

    /**
     * Check if this lesson is completed by a specific user
     */
    public function isCompletedBy($user): bool
    {
        $progress = $this->progressForUser($user);

        return $progress && $progress->isCompleted();
    }

    /**
     * Get the completion percentage for this lesson (0 or 100 for now)
     * Can be extended later for partial progress (e.g., video watch time)
     */
    public function completionPercentageForUser($user): int
    {
        return $this->isCompletedBy($user) ? 100 : 0;
    }

    // -------------------------------------------------------------------------
    // Scopes (already good, just keeping them)
    // -------------------------------------------------------------------------

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

}