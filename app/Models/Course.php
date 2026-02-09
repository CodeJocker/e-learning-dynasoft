<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "slug",
        "instructor_id",
        "description",
        "thumbnail",
        "category_id",
        "status",
        "published_at",
    ];

    protected $casts = [
        "published_at" => "datetime",
    ];

    // Relationships
    public function instructor()
    {
        return $this->belongsTo(User::class, "instructor_id");
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy("order");
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class)->orderBy("created_at", "desc");
    }

    // Helpers
    public function isPublished(): bool
    {
        return $this->status === "published" &&
            $this->published_at &&
            $this->published_at->isPast();
    }

    // Useful counts (for dashboard/cards)
    public function getLessonsCountAttribute()
    {
        return $this->lessons()->count();
    }

    public function getQuizzesCountAttribute()
    {
        return $this->quizzes()->count();
    }

    public function getEnrollmentsCountAttribute()
    {
        return $this->enrollments()->count();
    }
}
