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
        <a class="nav-link" href="{{ route('notifications-list', ['channel' => 'email']) }}">E-mail notifications</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('notifications-list', ['channel' => 'sms']) }}">SMS notifications</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('notifications-list', ['channel' => 'webPush']) }}">Web push notifications</a>
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
