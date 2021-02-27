<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailChannel;
use Auth;
use App\Http\Requests\SaveEmailChannelRequest;

class EmailChannelController extends Controller
{
    public function new() {
        return view('channels.email.form');
    }

    public function create(SaveEmailChannelRequest $r) {
        EmailChannel::create([
            'smtp_server_name' => $r->smtp_server_name,
            'port' => $r->port,
            'login' => $r->login,
            'password' => $r->password,
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('channels-list'))->with('successMessage', 'Email channel saved successfully');
    }

    public function edit($id) {
        $channel = Auth::user()->emailChannels()->where('id', '=', $id)->first();
        return view('channels.email.form', compact(['channel']));
    }

    public function update(SaveEmailChannelRequest $r, $id) {
        $channel = Auth::user()->emailChannels()->where('id', '=', $id)->first();
        $channel->smtp_server_name = $r->smtp_server_name;
        $channel->port = $r->port;
        $channel->login = $r->login;
        $channel->password = $r->password;
        $channel->save();

        return redirect(route('channels-list'))->with('successMessage', 'Email channel saved successfully');
    }
}
