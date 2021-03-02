<?php
namespace App\Services;
use App\User;

use App\Models\EmailChannel;
use App\Models\EmailNotification;
use Auth;
use \Carbon\Carbon;
use App\Utils\RequestUtil;
use App\Enums\SendingSourceEnum;
use Illuminate\Validation\ValidationException;

class EmailNotificationService
{
    public static function sendEmail($r){
        $user = Auth::user();
        $channel = $user->emailChannels[0] ?? null;
        $emailTemplate = $user->emailTemplates()->where('id', '=', $r->email_template_id)->first() ?? null;

        if($channel == null || !$channel->is_enabled) throw ValidationException::withMessages(['channel' => 'SMS channel is invalid or disabled']);

        if($emailTemplate == null) throw ValidationException::withMessages(['channel' => 'Invalid email template']);

        $not = EmailNotification::create([
            'sender_name' => $r->sender_name,
            'email' => $r->email,
            'content' => $emailTemplate->content,
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
            $not->sending_source = RequestUtil::isFromApi($r) ? SendingSourceEnum::API : SendingSourceEnum::WEB_PLATFORM;
            $not->save();
        } catch (\Throwable $th) { }

        return $not;
    }

    public function list($r) {
        $user = Auth::user();
        $applicationsIds = $user->applications()->select('id')->get();
        $notifications = EmailNotification::whereIn('application_id', $applicationsIds);

        if(!empty($r->from)) $notifications->where('sent_at', '>=', $r->from);

        if(!empty($r->to)) $notifications->where('sent_at', '<=', $r->to);

        if(!empty($r->sending_source)) $notifications->where('sending_source', '=', $r->sending_source);

        $notifications->orderBy('id', 'desc');

        return $notifications->paginate(5);
    }
}