@extends('layouts.app')

@section('content')

@include('layouts.menu')

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($templates as $template)
            <tr>
                <td>{{ $template->name }}</td>
                <td>
                    <a type="button" class="btn btn-sm btn-info" href="{{ route('email-templates-detail', $template->id) }}" target="_blank" >Details <i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a type="button" class="btn btn-sm btn-primary" href="{{ route('email-templates-delete', $template->id) }}">Delete <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </td>
            </tr>
        @endforeach
        @if ($templates->count() == 0)
            <tr>
                <td>No template found</td>
            </tr>
        @endif
    </tbody>
</table>


<a class="btn btn-sm btn-success float-right" href="{{ route('email-templates-new') }}">Add template <i class="fa fa-plus" aria-hidden="true"></i></a>


@endsection
