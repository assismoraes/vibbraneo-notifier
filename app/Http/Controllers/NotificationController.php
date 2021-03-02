<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmailNotificationService;
use App\Utils\RequestUtil;

class NotificationController extends Controller
{

    public $emailNotificationService;

    function __construct() {
        $this->emailNotificationService = new EmailNotificationService();
    }

    public function list(Request $r) {
        if($r->get('channel') == 'sms')
            $notifications = [];
        else if($r->get('channel') == 'webPush')
            $notifications = [];
        else
            $notifications = $this->emailNotificationService->list($r);

        return RequestUtil::isFromApi($r) ? $notifications : view('notifications.list', compact(['notifications']));
    }
}
