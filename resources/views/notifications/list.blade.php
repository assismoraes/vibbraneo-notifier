@extends('layouts.app')

@section('content')

@include('layouts.menu')

<style>
    .notification-details {
        padding: 0rem !important;
    }
</style>

<ul class="nav justify-content-end">
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
