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
                <option value="">-- Seleccionar categoria --</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @if (($item->category_name == $category && !old('categoria')) || (old('categoria') && old('categoria') == $category)) selected="" @endif>{{ $category }}</option>
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
        @empty(old('product_ids'))
            @foreach($item->products as $key => $product)
                <div class="card p-3 mb-3" id="item-{{$key + 1}}">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="productos_id_{{$key}}" class="form-label">Producto</label>
                            {{$key}}
                            <select name="productos[{{$key}}][id]" id="productos_id_{{$key}}" class="form-control">
                                <option value="" hidden>-- Seleccionar producto --</option>
                                @foreach($products as $item)

                                    <option value="{{$item->product_id}}" 
                                        @if ($item->product_id == $product->product_id) selected="" @endif
                                    >{{ $item->product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="productos_count_{{$key}}" class="form-label">Cantidad</label>
                            <input type="text" name="productos[{{$key}}][count]" id="productos_count_{{$key}}" class="form-control" value="{{ $product->count }}" />
                        </div>
                    </div>
                    @if ($key != 0)
                        <button type="button" class="btn btn-sm btn-dark remove-productos"><i class="bi bi-dash"></i></button>
                    @endif

                </div>
            @endforeach
        @endempty
        
        @if (!$has_products)
            <div class="card p-3 mb-3" id="item-1">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="productos_id_1" class="form-label">Producto</label>
                        <select name="productos_id[]" id="productos_id_1" class="form-control" required>
                            <option value="" hidden>-- Seleccionar producto --</option>
                            @foreach($products as $item)
                                <option value="{{$item->product_id}}">{{ $item->product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="productos_count_1" class="form-label">Cantidad</label>
                        <input type="text" name="productos_count[]" id="productos_count_1" class="form-control" required />
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row mb-3">
        <h3 class="col-12 h4">Cliente</h3>
        <div class="col-12">
            <label for="cliente" class="form-label">Seleccione el cliente a vincular (si no posee registre uno primero o deje vacio)</label>
            <select class="form-control form-control-md" name="cliente" id="cliente">
                <option value="" hidden>-- seleccionar cliente (puede cambiarse despues) --</option>
                @foreach($clients as $item2)
                    <option value="{{ $item2->id }}" @if ((!old('cliente') && $client_id == $item2->id) || (old('cliente') && old('cliente') == $item2->id)) selected='' @endif>({{ $item2->document }}) {{ $item2->name }} | {{ $item2->email }}</option>
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