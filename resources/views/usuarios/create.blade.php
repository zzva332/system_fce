
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Crear usuario del sistema</h1>
    <hr/>
</div>

<form action="{{ route('users.store') }}" method="post">
    @csrf
    <div class="row mb-3">
        <div class="col-sm-6 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}"/>
            @if ($errors->has('nombre'))
                <span class="text-danger">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"/>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control"/>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="confirmPassword" class="form-label">Confirmar password</label>
            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"/>
            @if ($errors->has('confirmPassword'))
                <span class="text-danger">{{ $errors->first('confirmPassword') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="role" class="form-label">Rol</label>
            <select class="form-control" name="role" id="role">
                <option value="" hidden> -- seleccionar rol --</option>
                <option value="Administrador">Administrador</option>
            </select>
            @if ($errors->has('role'))
                <span class="text-danger">{{ $errors->first('role') }}</span>
            @endif
        </div>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Regresar</a>
    <button type="submit" class="btn btn-dark">Guardar</button>
</form>
@endsection
