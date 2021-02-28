<a href="{{ route('register') }}" class="btn btn-sm btn-primary float-right" >Sign up <i class="fa fa-sign-in" aria-hidden="true"></i></a>
<br>

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" placeholder="Type your email" value="{{ old('email') }}">
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" placeholder="Type your password">
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-primary">Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
    <a href="{{url('/redirect')}}" class="btn btn-sm btn-primary float-right">Sign in/Sign up with Google <i class="fa fa-google" aria-hidden="true"></i> </a>
</form>