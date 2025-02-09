@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Editar producto</h1>
    <h2 class="h5">({{$item->id}} - {{$item->reference}})</h2>
    <hr />
</div>

<form action="{{ route('invoices.update', $item->id) }}" method="post" onsubmit="">
    @method('PUT')
    @csrf
    <div class="row mb-3">
        <h3 class="col-12 h4">Factura</h3>
        <div class="col-md-4 col-sm-6">
            <label for="id" class="form-label">ID</label>
            <input type="text" name="id" id="id" class="form-control" disabled value="{{ $item->id }}" />
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="numeroFactura" class="form-label">Numero de factura</label>
            <input type="text" name="numeroFactura" id="numeroFactura" class="form-control" disabled value="{{ $item->reference }}" />
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="categoria" class="form-label">Categoria</label>
            <select name="categoria" id="categoria" class="form-control">
                <option value="" hidden>-- Seleccionar categoria --</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @if ($item->category_name == $category) selected="" @endif>{{ $category }}</option>
                @endforeach
            </select>
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
                    <label for="nombreProd1" class="form-label">Producto</label>
                    <select name="nombreProd1" id="nombreProd1" class="form-control">
                        <option value="" hidden>-- Seleccionar producto --</option>
                        <option value="producto1">Producto 1</option>
                        <option value="producto1">Producto 2</option>
                        <option value="producto1">Producto 3</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="cantidadProd1" class="form-label">Cantidad</label>
                    <input type="text" name="cantidadProd1" id="cantidadProd1" class="form-control" />
                </div>
            </div>
        </div>
        <div class="card p-3 mb-3" id="item-2">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="nombreProd1" class="form-label">Producto</label>
                    <select name="nombreProd1" id="nombreProd1" class="form-control">
                        <option value="" hidden>-- Seleccionar producto --</option>
                        <option value="producto1">Producto 1</option>
                        <option value="producto1">Producto 2</option>
                        <option value="producto1">Producto 3</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="cantidadProd1" class="form-label">Cantidad</label>
                    <input type="text" name="cantidadProd1" id="cantidadProd1" class="form-control" />
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-dark remove-productos"><i class="bi bi-dash"></i></button>
        </div>
    </div>
    <div class="row mb-3">
        <h3 class="col-12 h4">Cliente</h3>
        <div class="col-12">
            <label for="cliente" class="form-label">Seleccione el cliente a vincular (si no posee registre uno primero o deje vacio)</label>
            <select class="form-control form-control-md" name="cliente" id="cliente">
                @foreach($clients as $item)
                    <option value="{{ $item->id }}">({{ $item->document }}) {{ $item->name }} | {{ $item->email }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="hidden" name="next" id="is_back"/>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Regresar</a>
    <button type="submit" class="btn btn-dark" name="action" value="g">Guardar</button>
    <button type="submit" class="btn btn-dark" name="action" value="gv">Guardar y visualizar</button>
</form>
@endsection