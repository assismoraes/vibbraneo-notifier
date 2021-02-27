<?php
namespace App\Services;
use App\User;

use App\Models\EmailChannel;
use App\Models\EmailNotification;
use Auth;

class EmailNotificationService
{
    public static function sendEmail($r){
        $user = Auth::user();
        $channel = $user->emailChannels[0];

        EmailNotification::create([
            'sender_name' => $r->sender_name,
            'email' => $r->email,
            'content' => $r->content,
            'application_id' => $r->application_id,
            'email_channel_id' => $channel->id
        ]);

        

    }
}