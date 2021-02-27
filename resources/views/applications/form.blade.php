@extends('layouts.app')

@section('content')

@include('layouts.menu')



<form method="post" action="{{ empty($application) ? route('applications-create') : route('applications-update', $application->id) }}" >
    @csrf
    
    @if(!empty($application)) @method('PUT') @endif

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name">Name</label>
            <input type="text" class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Type the application's name"
            value="{{ $application->name ?? '' }}"
            >
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        </div>
    </div>
    
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="uses_web_push" name="uses_web_push" value="uses_web_push"
        @if (!empty($application) && $application->uses_web_push)
            checked
        @endif
        >
        <label class="form-check-label" for="uses_web_push">Uses Web Push</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="uses_email" name="uses_email" value="uses_email"
        @if (!empty($application) && $application->uses_email)
            checked
        @endif
        >
        <label class="form-check-label" for="uses_email">Uses Email</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="uses_sms" name="uses_sms" value="uses_sms"
        @if (!empty($application) && $application->uses_sms)
            checked
        @endif
        >
        <label class="form-check-label" for="uses_sms">Uses SMS</label>
    </div>
    
    <button type="submit" class="btn btn-sm btn-success float-right">Save <i class="fa fa-floppy-o" aria-hidden="true"></i></button> 
    
</form>


@endsection
