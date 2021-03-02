<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'user_id'
    ];
}
