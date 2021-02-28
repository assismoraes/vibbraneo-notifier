<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmailNotificationService;

class NotificationController extends Controller
{

    public $emailNotificationService;

    function __construct() {
        $this->emailNotificationService = new EmailNotificationService();
    }

    public function list() {
        $emailNotifications = $this->emailNotificationService->list();

        return view('notifications.list', compact(['emailNotifications']));
    }
}
