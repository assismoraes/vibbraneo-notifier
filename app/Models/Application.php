<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = [];

    protected $hidden = ['user_id'];

    protected $casts = [
        'uses_email' => 'boolean',
        'uses_web_push' => 'boolean',
        'uses_sms' => 'boolean'
    ];

    public function emailNotifications() {
        return $this->hasMany('App\Models\EmailNotification');
    }
}
