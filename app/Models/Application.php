<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = [];

    public function emailNotifications() {
        return $this->hasMany('App\Models\EmailNotification');
    }
}
