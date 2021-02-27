@extends('layouts.app')

@section('content')

@include('layouts.menu')

<div class="card">
    <div class="card-header">
        {{ $application->name }}
    </div>
    <div class="card-body">
        <div class="row">
            @if ($application->uses_web_push)
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
            @if ($application->uses_email)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">E-mail Channel</h5>
                            <p class="card-text">You have no E-mail channel</p>
                            <a href="#" class="btn btn-sm btn-primary">Create an E-mail channel</a>
                        </div>
                    </div>
                </div>
            @endif
            @if ($application->uses_sms)
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
