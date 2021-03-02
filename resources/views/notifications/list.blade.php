@extends('layouts.app')

@section('content')

@include('layouts.menu')

<style>
    .notification-details {
        padding: 0rem !important;
    }
</style>

<ul class="nav justify-content-end">
    <form class="form-inline" action="" method="GET"  >
        <input type="hidden" name="page" value="{{ request()->get('page') }}"  >
        <input type="hidden" name="channel" value="{{ request()->get('channel') }}"  >
        <div class="form-group">
            <label for="sending_source">Sent by:</label>
            <select class="form-control form-control-sm mx-sm-3" name="sending_source" >
                <option value="">Choose a sending source</option>
                <option @if(request()->get('sending_source')=='API') selected @endif value="API">API</option>
                <option @if(request()->get('sending_source')=='WEB_PLATFORM') selected @endif value="WEB_PLATFORM">Web platform</option>
            </select>
        </div>
        <div class="form-group">
            <label for="from">From:</label>
            <input type="date" id="from" name="from" class="form-control form-control-sm mx-sm-3" value="{{ 
                !empty(request()->get('from')) ? \Carbon\Carbon::parse(request()->get('from'))->format('Y-m-d') : ''
            }}" >
        </div>
        <div class="form-group">
            <label for="to">To:</label>
            <input type="date" id="to" name="to" class="form-control form-control-sm mx-sm-3" value="{{ 
                !empty(request()->get('to')) ? \Carbon\Carbon::parse(request()->get('to'))->format('Y-m-d') : ''
            }}" >
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
        </div>
    </form>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('notifications-list', ['channel' => 'email']) }}">E-mail</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('notifications-list', ['channel' => 'sms']) }}">SMS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('notifications-list', ['channel' => 'webPush']) }}">Web push</a>
    </li>
</ul>

<h4>{{ request()->type }}</h4>

@if(request()->channel == 'email')
@include('notifications.email.list')
@elseif(request()->channel == 'sms')

@elseif(request()->channel == 'webPush')

@else
@include('notifications.email.list')
@endif

@endsection
