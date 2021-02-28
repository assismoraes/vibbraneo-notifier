@extends('layouts.app')

@section('content')

@include('layouts.menu')

<div class="card">
    <div class="card-header">
        Channels
    </div>
    <div class="card-body">
        <div class="row">
            @if(!Auth::user()->hasEmailChannels())
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">E-mail Channel</h5>
                            <p class="card-text">You have no E-mail channel</p>
                            <a href="{{ route('email-channels-new') }}" class="btn btn-sm btn-primary">Create an E-mail channel</a>
                        </div>
                    </div>
                </div>
            @else
                @php
                    $channel = Auth::user()->emailChannels[0];
                @endphp
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">E-mail Channel 
                                <a class="btn btn-sm btn-{{ $channel->is_enabled ? 'danger' : 'success' }}" 
                                    href="{{ route('email-channels-toggle', $channel->id) }}">
                                        {{ $channel->is_enabled ? 'Disable' : 'Enable' }} <i class="fa fa-toggle-{{ $channel->is_enabled ? 'on' : 'off' }}" aria-hidden="true"></i>
                                </a>
                            </h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">SMTP server name: <b>{{ $channel->smtp_server_name }}</b></li>
                                <li class="list-group-item">Port: <b>{{ $channel->port }}</b></li>
                                <li class="list-group-item">Login: <b>{{ $channel->login }}</b></li>
                                <li class="list-group-item">Password: <b>{{  str_repeat("*", strlen($channel->password)) }}</b></li>
                            </ul>
                            <br>
                            <a href="{{ route('email-notifications-new') }}" class="btn btn-sm btn-primary float-left @if(!$channel->is_enabled) disabled @endif">Send email <i class="fa fa-paper-plane-o" aria-hidden="true"></i></a>
                            <a href="{{ route('email-channels-edit', $channel->id) }}" class="btn btn-sm btn-primary float-right">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            @endif


            @if(!Auth::user()->hasSmsChannels())
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">SMS Channel</h5>
                            <p class="card-text">You have no SMS channel</p>
                            <a href="{{ route('sms-channels-new') }}" class="btn btn-sm btn-primary">Create a SMS channel</a>
                        </div>
                    </div>
                </div>
            @else
                @php
                    $channel = Auth::user()->smsChannels[0];
                @endphp
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">SMS Channel</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">SMS provider: <b>{{ $channel->sms_provider }}</b></li>
                                <li class="list-group-item">Login: <b>{{ $channel->login }}</b></li>
                                <li class="list-group-item">Password: <b>{{  str_repeat("*", strlen($channel->password)) }}</b></li>
                            </ul>
                            <br>
                            <a href="{{ route('sms-channels-edit', $channel->id) }}" class="btn btn-sm btn-primary float-right">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            @endif
            
            
        </div>
    </div>
</div>

@endsection
