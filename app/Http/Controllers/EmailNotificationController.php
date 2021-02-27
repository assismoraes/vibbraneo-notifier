<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendEmailNotificationRequest;
use App\Services\EmailNotificationService;
use Auth;

class EmailNotificationController extends Controller
{
    public function new() {
        $applications = Auth::user()->applications()->where('uses_email', '=', true)->get();
        return view('notifications.email.form', compact(['applications']));
    }

    public function send(SendEmailNotificationRequest $r) {
        EmailNotificationService::sendEmail($r);

        return redirect(route('channels-list'))->with('successMessage', 'Email notification sent successfully');
    }
}
