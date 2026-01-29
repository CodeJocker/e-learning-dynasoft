<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'description',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    // -------------------------------------------------------------------------
    // Scopes (very useful in controllers)
    // -------------------------------------------------------------------------

    /**
     * Only active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Ordered by display_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('name');
    }

    // -------------------------------------------------------------------------
    // Accessors / Mutators (optional but nice)
    // -------------------------------------------------------------------------

    public function getIconUrlAttribute(): ?string
    {
        if (! $this->icon) {
            return null;
        }

        // Example: if you store heroicon names
        if (str_starts_with($this->icon, 'heroicon-')) {
            return null; // frontend will use heroicons component
        }

        // or if you store real image paths
        return asset('storage/'.$this->icon);
    }
}
