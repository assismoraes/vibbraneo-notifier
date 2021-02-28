<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    protected $guarded = [];

    protected $casts = [
        'sent_at' => 'datetime',
        'sent' => 'boolean'
    ];
}
