<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = [];

    protected $hidden = ['user_id'];

    public function emailNotifications() {
        return $this->hasMany('App\Models\EmailNotification');
    }
}
