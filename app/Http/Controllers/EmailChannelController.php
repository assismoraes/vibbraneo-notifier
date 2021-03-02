<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailChannel;
use Auth;
use App\Http\Requests\SaveEmailChannelRequest;
use App\Utils\RequestUtil;

class EmailChannelController extends Controller
{
    public function new() {
        return view('channels.email.form');
    }

    public function createOrUpdate(SaveEmailChannelRequest $r) {
        $channel = Auth::user()->emailChannels()->first();

        if(empty($channel)) $channel = new EmailChannel();

        $channel->smtp_server_name = $r->smtp_server_name;
        $channel->port = $r->port;
        $channel->login = $r->login;
        $channel->password = $r->password;
        $channel->user_id = Auth::user()->id;
        
        $channel->save();

        return RequestUtil::isFromApi($r) ? $channel : redirect(route('channels-list'))->with('successMessage', 'Email channel saved successfully');
    }

    public function edit() {
        $channel = Auth::user()->emailChannels()->first();
        
        return view('channels.email.form', compact(['channel']));
    }

    public function toggle(Request $r) {
        $channel = Auth::user()->emailChannels()->first();
        
        if(empty($channel)) {
            return RequestUtil::isFromApi($r) ? response(['message' => 'No email channel avaiable'], 404) : redirect()->back()->with('errorMessage', 'No email channel avaiable');
        }

        $channel->is_enabled = !$channel->is_enabled;
        $channel->save();

        $message = 'Email channel ' . ($channel->is_enabled ? 'enabled' : 'disabled') . ' successfully';
        return RequestUtil::isFromApi($r) ? $channel : redirect(route('channels-list'))->with('successMessage', $message);
    }

    public function get() {
        $channel = Auth::user()->emailChannels()->first();

        if(empty($channel)) return response(['message' => 'No email channel avaiable'], 404);

        return $channel;
    }
}
