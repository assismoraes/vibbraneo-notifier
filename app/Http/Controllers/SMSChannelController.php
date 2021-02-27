<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveSMSChannelRequest;
use App\Models\SmsChannel;
use Auth;

class SMSChannelController extends Controller
{
    public function new() {
        return view('channels.sms.form');
    }

    public function create(SaveSMSChannelRequest $r) {
        SmsChannel::create([
            'sms_provider' => $r->sms_provider,
            'login' => $r->login,
            'password' => $r->password,
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('channels-list'))->with('successMessage', 'SMS channel saved successfully');
    }

    public function edit($id) {
        $channel = Auth::user()->smsChannels()->where('id', '=', $id)->first();
        return view('channels.sms.form', compact(['channel']));
    }

    public function update(SaveSMSChannelRequest $r, $id) {
        $channel = Auth::user()->smsChannels()->where('id', '=', $id)->first();
        $channel->sms_provider = $r->sms_provider;
        $channel->login = $r->login;
        $channel->password = $r->password;
        $channel->save();

        return redirect(route('channels-list'))->with('successMessage', 'SMS channel saved successfully');
    }
}
