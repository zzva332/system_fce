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
                    <option value="{{ $category }}">{{ $category }}</option>
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
        <div class="card p-3 mb-3" id="item-1">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="product_id_1" class="form-label">Producto</label>
                    <select name="product_id[]" id="product_id_1" class="form-control">
                        <option value="" hidden>-- Seleccionar producto --</option>
                        @foreach($products as $item)
                            <option value="{{$item->product_id}}">{{ $item->product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="count_1" class="form-label">Cantidad</label>
                    <input type="text" name="count[]" id="count_1" class="form-control" />
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <h3 class="col-12 h4">Cliente</h3>
        <div class="col-12">
            <label for="cliente" class="form-label">Seleccione el cliente a vincular (si no posee registre uno primero o deje vacio)</label>
            <select class="form-control form-control-md" name="cliente" id="cliente">
                <option value="0" hidden>-- seleccionar documento --</option>
                @foreach($clients as $item)
                    <option value="{{ $item->id }}">({{ $item->document }}) {{ $item->name }} | {{ $item->email }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Regresar</a>
    <button type="submit" class="btn btn-dark">Guardar</button>
    <button type="submit" class="btn btn-dark">Guardar y visualizar</button>
</form>

@endsection