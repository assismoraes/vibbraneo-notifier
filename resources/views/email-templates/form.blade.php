@extends('layouts.app')

@section('content')

@include('layouts.menu')

<form method="post" action="{{ route('email-templates-save') }}" enctype="multipart/form-data" >
    @csrf

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Type the template name" value="{{ old('name') }}" >
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="template">HTML template file</label>
            <input type="file" class="form-control-file form-control form-control-sm {{ $errors->has('template') ? 'is-invalid' : '' }}" id="template" name="template" accept=".html" >
            <div class="invalid-feedback">
                {{ $errors->first('template') }}
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-sm btn-success float-right">Save <i class="fa fa-floppy-o" aria-hidden="true"></i></button> 
    
</form>


@endsection
