@extends('layouts.app')

@section('content')

@include('layouts.menu')

<form method="post" action="{{ empty($channel) ? route('sms-channels-create') : route('sms-channels-update', $channel->id) }}" >
    
    @csrf
    
    @if(!empty($channel)) @method('PUT') @endif
    
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="sms_provider">SMS provider</label>
            <input type="text" class="form-control form-control-sm {{ $errors->has('sms_provider') ? 'is-invalid' : '' }}" id="sms_provider" name="sms_provider" placeholder="Type SMS provider"
                value="{{ old('sms_provider') ?? $channel->sms_provider ?? '' }}"
            >
            <div class="invalid-feedback">
                {{ $errors->first('sms_provider') }}
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
