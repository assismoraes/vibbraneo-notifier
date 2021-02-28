<?php
namespace App\Services;
use App\User;

use App\Models\EmailChannel;
use App\Models\EmailNotification;
use Auth;
use \Carbon\Carbon;

class EmailNotificationService
{
    public static function sendEmail($r){
        $user = Auth::user();
        $channel = $user->emailChannels[0];

        $not = EmailNotification::create([
            'sender_name' => $r->sender_name,
            'email' => $r->email,
            'content' => $r->content,
            'application_id' => $r->application_id,
            'email_channel_id' => $channel->id
        ]);

        $details = [
            'to' => $not->email,
            'from' => $channel->login,
            'subject' => 'Subject',
            'title' => 'Title',
            'content'  => $not->content
        ];

        config([
            'mail.driver' => 'smtp',
            'mail.host' => $channel->smtp_server_name,
            'mail.port' => $channel->port,
            'mail.username' => $channel->login,
            'mail.password' => $channel->password,
            'mail.encryption' => 'tls'
        ]);

        try {
            \Mail::to($not->email)->send(new \App\Mail\Mailer($details));
            $not->sent_at = Carbon::now();
            $not->sent = true;
            $not->save();
        } catch (\Throwable $th) { }

        return $not;
    }
}