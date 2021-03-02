<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailChannel extends Model
{

    protected $guarded = [];

    protected $hidden = [
        'user_id'
    ];

    protected $casts = [
        'is_enabled' => 'boolean'
    ];

    public function user() {
        return $this->belongstTo('App\User');
    }
}
