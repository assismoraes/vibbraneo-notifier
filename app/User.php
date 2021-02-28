<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company_name', 'phone_number', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function applications() {
        return $this->hasMany('\App\Models\Application');
    }

    public function hasWebPushChannel() {
        return false;
    }

    public function emailChannels() {
        return $this->hasMany('App\Models\EmailChannel');
    }

    public function smsChannels() {
        return $this->hasMany('App\Models\SmsChannel');
    }

    public function hasSmsChannel() {
        return false;
    }

    public function hasEmailChannels() {
        return $this->emailChannels()->count() > 0;
    }

    public function hasSmsChannels() {
        return $this->smsChannels()->count() > 0;
    }
}
