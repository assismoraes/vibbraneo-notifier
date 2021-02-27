@extends('layouts.app')

@section('content')

@include('layouts.menu')

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Uses web push</th>
            <th scope="col">Uses email</th>
            <th scope="col">Uses SMS</th>
            <th scope="col">Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($applications as $app)
            <tr>
                <td>{{ $app->name }}</td>
                <td>{{ $app->uses_web_push ? 'Yes' : 'No' }}</td>
                <td>{{ $app->uses_email ? 'Yes' : 'No' }}</td>
                <td>{{ $app->uses_sms ? 'Yes' : 'No' }}</td>
                <td>
                    <a type="button" class="btn btn-sm btn-primary" href="{{ route('applications-edit', $app->id) }}">Edit</a>
                </td>
            </tr>
        @endforeach
        @if ($applications->count() == 0)
            <tr>
                <td>No application found</td>
            </tr>
        @endif
    </tbody>
</table>

@if ($applications->count() == 0)
    <a class="btn btn-sm btn-success float-right" href="{{ route('applications-new') }}">Add application <i class="fa fa-plus" aria-hidden="true"></i></a>
@endif

@endsection
