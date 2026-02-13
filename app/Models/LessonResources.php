<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'type',
        'path',
        'url',
        'description',
        'display_order',
        'is_downloadable',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // -------------------------------------------------------------------------
    // Accessors
    // -------------------------------------------------------------------------

    public function getDisplayUrlAttribute(): ?string
    {
        if ($this->url) {
            return $this->url;
        }

        if ($this->path) {
            return asset('storage/' . $this->path);
        }

        return null;
    }

    public function isExternal(): bool
    {
        return in_array($this->type, ['link', 'embed']);
    }

    public function isFile(): bool
    {
        return in_array($this->type, ['pdf', 'video', 'image', 'audio', 'file']);
    }
}