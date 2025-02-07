
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Crear usuario del sistema</h1>
    <hr/>
</div>

<form action="{{ route('clients.store') }}" method="post">
    @csrf
    <div class="row mb-3">
        <div class="col-sm-6 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"/>
            @if ($errors->has('nombre'))
                <span class="text-danger">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control"/>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="tipo_id" class="form-label">Tipo ID</label>
            <select name="tipo_id" id="tipo_id" class="form-control">
                <option value="" hidden>-- seleccionar documento --</option>
                <option value="CC">Cedula ciudadania</option>
                <option value="CE">Cedula extranjeria</option>
                <option value="TI">Tarjeta identidad</option>
            </select>
            @if ($errors->has('tipo_id'))
                <span class="text-danger">{{ $errors->first('tipo_id') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input type="text" name="documento" id="documento" class="form-control"/>
            @if ($errors->has('documento'))
                <span class="text-danger">{{ $errors->first('documento') }}</span>
            @endif
        </div>
    </div>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Regresar</a>
    <button type="submit" class="btn btn-dark">Guardar</button>
</form>

@endsection
