@extends('layout_login')

@section('title', 'Forge password')

@section('content')
<form class="card col-lg-3 col-md-4 col-12">
    <div class="card-body">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" placeholder="example@example.com" class="form-control">
        </div>
        
        <div class="mb-3 d-flex">
            <a class="btn btn-white w-100" href="{{ route('index') }}">Cancel</a>
            <a class="btn btn-dark w-100">Reset password</a>
        </div>
    </div>
</form>
@endsection