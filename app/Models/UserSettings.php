<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserSettings extends Authenticatable implements MustVerifyEmail
{
    protected $fillable = [
        'user_id',
        'notification_days_before',
        'notification_days_after',
    ];
}
