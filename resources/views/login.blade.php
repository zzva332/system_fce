@extends('layout_login')
@section('title', 'Page Title')

@section('content')
<form method="post" class="card col-lg-3 col-md-6 col-12" action="{{ route('login') }}">
    @csrf
    <div class="card-body">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" placeholder="example@example.com" class="form-control" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" placeholder="******" class="form-control">
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <a class="btn-link text-dark" href="{{ route('forget_password') }}">Forgot password?</a>
        </div>
        <div class="mb-3 d-flex">
            <button class="btn btn-dark w-100" type="submit">Sign In</button>
        </div>
    </div>
</form>
@endsection