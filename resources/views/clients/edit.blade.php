
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Editar cliente</h1>
    <h2 class="h5">({{$item->name}})</h2>
    <hr/>
</div>

<form action="{{ route('clients.update', $item->id) }}" method="post">
    @method('PUT')
    @csrf
    <div class="row mb-3">
        <div class="col-sm-6 mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" name="id" id="id" class="form-control" disabled value="{{ $item->id }}"/>
        </div>
        <div class="col-sm-6 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') ? old('nombre') : $item->name }}" />
            @if ($errors->has('nombre'))
                <span class="text-danger">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ? old('email') : $item->email }}" />
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="tipo_id" class="form-label">Tipo ID</label>
            <select name="tipo_id" id="tipo_id" class="form-control">
                <option value="" hidden>-- seleccionar documento --</option>
                @foreach($list_types_id as $types)
                    <option value="{{$types['key']}}" @if ( ($item->type_id == $types['key'] && !old('tipo_id')) || (old('tipo_id') && old('tipo_id') == $types['key']))
                        selected=""
                    @endif
                    >{{$types['value']}}</option>
                @endforeach
            </select>
            @if ($errors->has('tipo_id'))
                <span class="text-danger">{{ $errors->first('tipo_id') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input type="text" name="documento" id="documento" class="form-control" value="{{ old('documento') ? old('documento') : $item->document }}"/>
            @if ($errors->has('documento'))
                <span class="text-danger">{{ $errors->first('documento') }}</span>
            @endif
        </div>
    </div>
    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Regresar</a>
    <button type="submit" class="btn btn-dark">Guardar</button>
</form>

@endsection
