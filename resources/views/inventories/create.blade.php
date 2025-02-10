
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Crear inventario</h1>
    <hr/>
</div>

<form action="{{ route('inventories.store') }}" method="post">
    @csrf
    <div class="row mb-3">
        <div class="col-sm-6 mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control">
                <option value="" hidden>-- Seleccionar producto --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" @if (old('producto_id') == $product->id) selected @endif>{{ $product->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('producto_id'))
                <span class="text-danger">{{ $errors->first('producto_id') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="stock" class="form-label">Cantidad stock</label>
            <input type="text" name="stock" id="stock" class="form-control" value="{{ old('stock') }}"/>
            @if ($errors->has('stock'))
                <span class="text-danger">{{ $errors->first('stock') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="iva" class="form-label">Porcentaje iva</label>
            <input type="text" name="iva" id="iva" class="form-control" placeholder="ej. 10, 20, 30" value="{{ old('iva') }}"/>
            @if ($errors->has('iva'))
                <span class="text-danger">{{ $errors->first('iva') }}</span>
            @endif
        </div>
        <div class="col-sm-6 mb-3">
            <label for="descuento" class="form-label">Porcentaje descuento</label>
            <input type="text" name="descuento" id="descuento" class="form-control" placeholder="ej. 10, 20, 30" value="{{ old('descuento') }}"/>
            @if ($errors->has('descuento'))
                <span class="text-danger">{{ $errors->first('descuento') }}</span>
            @endif
        </div>
    </div>
    <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Regresar</a>
    <button type="submit" class="btn btn-dark">Guardar</button>
</form>

@endsection
