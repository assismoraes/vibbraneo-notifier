@extends('layouts.app')

@section('content')

@include('layouts.menu')

<form method="post" action="{{ empty($channel) ? route('email-channels-create') : route('email-channels-update', $channel->id) }}" >
    
    @csrf
    
    @if(!empty($channel)) @method('PUT') @endif
    
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="smtp_server_name">SMTP Server Name</label>
            <input type="text" class="form-control form-control-sm {{ $errors->has('smtp_server_name') ? 'is-invalid' : '' }}" id="smtp_server_name" name="smtp_server_name" placeholder="Type SMTP Server Name"
                value="{{ old('smtp_server_name') ?? $channel->smtp_server_name ?? '' }}"
            >
            <div class="invalid-feedback">
                {{ $errors->first('smtp_server_name') }}
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="port">Port</label>
            <input type="number" class="form-control form-control-sm {{ $errors->has('port') ? 'is-invalid' : '' }}" id="port" name="port" placeholder="Type port"
                value="{{ old('port') ?? $channel->port ?? '' }}"
            >
            <div class="invalid-feedback">
                {{ $errors->first('port') }}
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="login">Login</label>
            <input type="text" class="form-control form-control-sm {{ $errors->has('login') ? 'is-invalid' : '' }}" id="login" name="login" placeholder="Type login"
                value="{{ old('login') ?? $channel->login ?? '' }}"
            >
            <div class="invalid-feedback">
                {{ $errors->first('login') }}
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="password">Password</label>
            <input type="password" class="form-control form-control-sm {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="Type your password">
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Type your password confirmation">
        </div>
    </div>
    
    <button type="submit" class="btn btn-sm btn-primary">Save <i class="fa fa-floppy-o" aria-hidden="true"></i></button> 
    
</form>

@endsection
