<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $fillable = [
        'quiz_attempt_id',
        'quiz_question_id',
        'submitted_value',
        'file_path',
        'marks_awarded',
    ];

    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    public function getSelectedOptionIdsAttribute()
    {
        if (! $this->submitted_value) {
            return [];
        }

        if (str_contains($this->submitted_value, '[')) {
            return json_decode($this->submitted_value, true)['selected'] ?? [];
        }

        return array_filter(explode(',', $this->submitted_value));
    }

    public function hasFile(): bool
    {
        return ! empty($this->file_path);
    }
}
