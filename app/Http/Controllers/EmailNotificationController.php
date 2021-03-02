<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendEmailNotificationRequest;
use App\Services\EmailNotificationService;
use Auth;
use App\Utils\RequestUtil;

class EmailNotificationController extends Controller
{
    public function new() {
        $applications = Auth::user()->applications()->where('uses_email', '=', true)->get();
        $templates = Auth::user()->emailTemplates()->get();
        
        return view('notifications.email.form', compact(['applications', 'templates']));
    }

    public function send(SendEmailNotificationRequest $r) {
        $not = EmailNotificationService::sendEmail($r);

        if($not->sent)
            return RequestUtil::isFromApi($r) ? response(['message' => 'Email notification sent successfully'], 200) : redirect(route('channels-list'))->with('successMessage', 'Email notification sent successfully');
        
        return RequestUtil::isFromApi($r) ? response(['message' => 'Email notification not sent. Try again later.'], 200) : redirect(route('channels-list'))->with('errorMessage', 'Email notification not sent. Try again later.');
    }
}
