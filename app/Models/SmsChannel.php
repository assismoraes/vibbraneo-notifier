<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsChannel extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongstTo('App\User');
    }
}
