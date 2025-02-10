@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Crear producto</h1>
    <hr />
</div>

<form action="{{ route('invoices.store') }}" method="post">
    @csrf
    <div class="row mb-3">
        <h3 class="col-12 h4">Factura</h3>
        <div class="col-sm-6">
            <label for="numeroFactura" class="form-label">Numero de factura reportada</label>
            <input type="text" name="numeroFactura" id="numeroFactura" class="form-control" value="____-____-____-____" disabled />
        </div>
        <div class="col-sm-6">
            <label for="categoria" class="form-label">Categoria</label>
            <select name="categoria" id="categoria" class="form-control">
                <option value="" hidden>-- Seleccionar categoria --</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @if(old('categoria') == $category) selected @endif>{{ $category }}</option>
                @endforeach
            </select>
            @if ($errors->has('categoria'))
                <span class="text-danger">{{ $errors->first('categoria') }}</span>
            @endif
        </div>
    </div>
    <div id="info-productos" class="mb-3">
        <h3 class="h4">Productos</h3>
        <div class="d-flex justify-content-end">
            <button type="button" id="add-new-products" class="btn btn-sm btn-dark"><i class="bi bi-plus-lg"></i></button>
        </div>
        @for ($i = 0; $i < (session('count_product') ?? 1); $i++)
        <div class="card p-3 mb-3" id="item-{{$i+1}}">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="productos_id_{{$i}}" class="form-label">Producto</label>
                    <select name="productos[{{$i}}][id]" id="productos_id_{{$i}}" class="form-control">
                        <option value="" hidden>-- Seleccionar producto --</option>
                        @foreach($products as $item)
                            <option value="{{$item->product_id}}" @if (old("productos.$i.id") == $item->product_id) selected @endif>{{ $item->product->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has("productos.$i.id"))
                        <span class="text-danger">{{ $errors->first("productos.$i.id") }}</span>
                    @endif
                </div>
                <div class="col-sm-6">
                    <label for="productos_count_{{$i}}" class="form-label">Cantidad</label>
                    <input type="text" name="productos[{{$i}}][count]" id="productos_count_{{$i}}" class="form-control" value='{{old("productos.$i.count")}}' />
                    @if ($errors->has("productos.$i.count"))
                        <span class="text-danger">{{ $errors->first("productos.$i.count") }}</span>
                    @endif
                </div>
            </div>
            @if ($i != 0)
                <button type="button" class="btn btn-sm btn-dark remove-productos"><i class="bi bi-dash"></i></button>
            @endif
        </div>
        @endfor
    </div>
    <div class="row mb-3">
        <h3 class="col-12 h4">Cliente</h3>
        <div class="col-12">
            <label for="cliente" class="form-label">Seleccione el cliente a vincular (si no posee registre uno primero o deje vacio)</label>
            <select class="form-control form-control-md" name="cliente" id="cliente">
                <option value="" hidden>-- seleccionar cliente (puede cambiarse despues) --</option>
                @foreach($clients as $item)
                    <option value="{{ $item->id }}" @if(old('cliente') == $item->id) selected @endif>({{ $item->document }}) {{ $item->name }} | {{ $item->email }}</option>
                @endforeach
            </select>
            @if ($errors->has('cliente'))
                <span class="text-danger">{{ $errors->first('cliente') }}</span>
            @endif
        </div>
    </div>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Regresar</a>
    <button type="submit" class="btn btn-dark" name="action" value="g">Guardar</button>
    <button type="submit" class="btn btn-dark" name="action" value="gv">Guardar y visualizar</button>
</form>

@endsection