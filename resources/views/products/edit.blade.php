
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Editar producto</h1>
    <h2 class="h5">({{$item->name}})</h2>
    <hr/>
</div>

<form action="{{ route('products.update', $item->id) }}" method="post">
    @method('PUT')
    @csrf
    <div class="row mb-3">
        <div class="col-sm-6 mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" name="id" id="id" class="form-control" disabled value="{{ $item->id }}"/>
        </div>
        <div class="col-sm-6 mb-3">
            <label for="codigo" class="form-label">Codigo</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo') ? old('codigo') : $item->code }}"/>
            @if ($errors->has('codigo'))
                <span class="text-danger">{{ $errors->first('codigo') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') ? old('nombre') : $item->name }}"/>
            @if ($errors->has('nombre'))
                <span class="text-danger">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="text" name="precio" id="precio" class="form-control" value="{{ old('precio') ? old('precio') : $item->price }}"/>
            @if ($errors->has('precio'))
                <span class="text-danger">{{ $errors->first('precio') }}</span>
            @endif
        </div>
        <div class="col-sm-12 mb-3">
            <label for="descripcion" class="form-label">Descripcion</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4">{{ old('descripcion') ? old('descripcion') : $item->description }}</textarea>
            @if ($errors->has('descripcion'))
                <span class="text-danger">{{ $errors->first('descripcion') }}</span>
            @endif
        </div>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Regresar</a>
    <button type="submit" class="btn btn-dark">Guardar</button>
</form>

@endsection
