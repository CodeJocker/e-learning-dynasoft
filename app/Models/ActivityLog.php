<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'action',
        'actor_type',
        'actor_id',
        'subject_type',
        'subject_id',
        'meta'
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
