@extends('layouts.app')

@section('content')

@include('layouts.menu')

@if ($application)
    <div class="card">
        <div class="card-header">
            Application details <a href="{{ route('applications-edit', $application->id) }}" class="btn btn-sm btn-success float-right" >Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Name: <b>{{ $application->name }}</b> </li>
                <li class="list-group-item">Uses SMS channel: <b>{{ $application->uses_sms ? 'Yes' : 'No' }}</b> </li>
                <li class="list-group-item">Uses E-mail channel: <b>{{ $application->uses_email ? 'Yes' : 'No' }}</b> </li>
                <li class="list-group-item">Uses Web Push channel: <b>{{ $application->uses_web_push ? 'Yes' : 'No' }}</b> </li>
            </ul>
        </div>
    </div>
@else
    <p>Application not found</p>
@endif
@endsection
