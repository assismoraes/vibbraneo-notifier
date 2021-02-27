@extends('layouts.app')

@section('content')

@foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach

<form method="post" action="{{ route('register') }}" >
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Type your name">
        </div>
        <div class="form-group col-md-6">
            <label for="email">E-mail</label>
            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Type your email">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="company_name">Company</label>
            <input type="text" class="form-control form-control-sm" id="company_name" name="company_name" placeholder="Type your company's name">
        </div>
        <div class="form-group col-md-6">
            <label for="phone_number">Phone number</label>
            <input type="text" class="form-control form-control-sm" id="phone_number" name="phone_number" placeholder="Type your phone number">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="address">Address</label>
            <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="Type your address">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Type your password">
        </div>
        <div class="form-group col-md-6">
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Type your password confirmation">
        </div>
    </div>
    
    <button type="submit" class="btn btn-sm btn-primary">Sign up</button> 
    <a href="{{url('/redirect')}}" class="btn btn-sm btn-primary float-right">Sign up with Google <i class="fa fa-google" aria-hidden="true"></i> </a>
    
</form>


@endsection
