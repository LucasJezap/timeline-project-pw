<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineEventCategory extends Model
{
    protected $fillable = [
        'timeline_event_id',
        'category_id',
    ];
}
