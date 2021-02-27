@if($message = Session::get('successMessage'))
    <div class="alert alert-success" role="alert">
        <p class="mb-0">{{ $message }}</p> 
    </div>
@endif

@if($message = Session::get('errorMessage'))
    <div class="alert alert-danger" role="alert">
        <p class="mb-0">{{ $message }}</p> 
    </div>
@endif