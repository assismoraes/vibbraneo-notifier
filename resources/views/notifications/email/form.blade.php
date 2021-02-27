@extends('layouts.app')

@section('content')

@include('layouts.menu')

<form method="post" action="{{ route('email-notifications-send') }}" >
    
    @csrf
    
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="sender_name">Sender name</label>
            <input type="text" class="form-control form-control-sm {{ $errors->has('sender_name') ? 'is-invalid' : '' }}" id="sender_name" name="sender_name" placeholder="Type the sender name"
                value="{{ old('sender_name') ?? 'joao de santo cristo' }}"
            >
            <div class="invalid-feedback">
                {{ $errors->first('sender_name') }}
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="email" class="form-control form-control-sm {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Type the e-mail"
                value="{{ old('email') ?? 'axmraz@gmail.com' }}"
            >
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="application_id">Application</label>
            <select class="form-control form-control-sm {{ $errors->has('application_id') ? 'is-invalid' : '' }}" name="application_id" id="application_id" >
                <option value="">Choose an application</option>
                @foreach ($applications as $application)
                    <option selected value="{{ $application->id }}" >{{ $application->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('application_id') }}
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="content">Login</label>
            <textarea name="content" id="content" class="form-control form-control-sm {{ $errors->has('content') ? 'is-invalid' : '' }}" cols="30" rows="10">{{ old('content') ?? 'conteudo para envio' }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('content') }}
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-sm btn-primary">Send <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button> 
    
</form>

@endsection
