<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'min_percent_required',
        'require_all_lessons',
        'require_all_quizzes',
        'min_quiz_average',
        'min_attendance_percent',
        'requires_portfolio',
        'description',
    ];

    protected $casts = [
        'min_percent_required' => 'decimal:2',
        'require_all_lessons' => 'boolean',
        'require_all_quizzes' => 'boolean',
        'requires_portfolio' => 'boolean',
    ];

    // Relationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Example check method (used later when progress updates)
    public function isSatisfiedBy(CourseProgress $progress): bool
    {
        if ($progress->percent_completed < $this->min_percent_required) {
            return false;
        }

        if ($this->require_all_lessons && $progress->lessons_completed_count < $this->course->lessons()->count()) {
            return false;
        }

        return true;
    }
}
