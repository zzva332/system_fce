
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Editar inventario</h1>
    <h2 class="h5">({{ $item->product->name }})</h2>
    <hr/>
</div>

<form action="{{ route('inventories.update', $item->id) }}" method="post">
    @method('PUT')
    @csrf

    <div class="row mb-3">
        <div class="col-sm-6 mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" name="id" id="id" class="form-control" value="{{ $item->id }}" disabled/>
        </div>
        <div class="col-sm-6 mb-3">
            <label for="producto" class="form-label">Producto</label>
            <input type="text" name="producto" id="producto" class="form-control" value="{{ $item->product->name }}" disabled/>
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <label for="stock" class="form-label">Cantidad stock</label>
            <input type="text" name="stock" id="stock" class="form-control" value="{{ $item->stock }}"/>
            @if ($errors->has('stock'))
                <span class="text-danger">{{ $errors->first('stock') }}</span>
            @endif
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <label for="iva" class="form-label">Porcentaje iva</label>
            <input type="text" name="iva" id="iva" class="form-control" value="{{ $item->iva }}"/>
            @if ($errors->has('iva'))
                <span class="text-danger">{{ $errors->first('iva') }}</span>
            @endif
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <label for="descuento" class="form-label">Porcentaje descuento</label>
            <input type="text" name="descuento" id="descuento" class="form-control" value="{{ $item->discount }}"/>
            @if ($errors->has('descuento'))
                <span class="text-danger">{{ $errors->first('descuento') }}</span>
            @endif
        </div>
    </div>

    <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Regresar</a>
    <button type="submit" class="btn btn-dark">Guardar</button>
</form>

@endsection
