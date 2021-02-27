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
                        <h5 class="card-title">E-mail Channel</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">SMTP server name: <b>{{ $channel->smtp_server_name }}</b></li>
                            <li class="list-group-item">Port: <b>{{ $channel->port }}</b></li>
                            <li class="list-group-item">Login: <b>{{ $channel->login }}</b></li>
                            <li class="list-group-item">Password: <b>{{  str_repeat("*", strlen($channel->password)) }}</b></li>
                        </ul>
                        <br>
                        <a href="{{ route('email-channels-edit', $channel->id) }}" class="btn btn-sm btn-primary float-right">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            @endif
            
            
            
            
            @if (!Auth::user()->hasWebPushChannel())
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Web Push Channel</h5>
                        <p class="card-text">You have no Web Push Channel</p>
                        <a href="#" class="btn btn-sm btn-primary">Create an Web Push channel</a>
                    </div>
                </div>
            </div>    
            @endif
            
            @if (!Auth::user()->hasSmsChannel())
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">SMS Channel</h5>
                        <p class="card-text">You have no SMS channel</p>
                        <a href="#" class="btn btn-sm btn-primary">Create a SMS channel</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection