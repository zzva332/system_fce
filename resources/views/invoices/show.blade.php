@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Ver factura #{{ $invoice->id}}</h1>
    <hr />
</div>
<div class="row mb-4">
    <div class="col-sm-6">
        <div class="card p-3">
            <h3>Informacion basica</h3>
            <p>ID: </span>{{ $invoice->id }}</span></p>
            <p>Numero de factura: </span>{{ $invoice->reference }}</span></p>
            <p>Categoria: </span>{{ $invoice->category_name }}</span></p>
            <p>Fecha creacion: </span>{{ \Carbon\Carbon::parse($invoice->create_at)->format('d-m-Y H:i:s') }}</span></p>
            <p>Fecha modificacion: </span>{{ \Carbon\Carbon::parse($invoice->update_at)->format('d-m-Y H:i:s') }}</span></p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card p-3">
            <h3>Cliente</h3>
            @if ($invoice->client != null)
            <p>Nombre: <span>{{ $invoice->client->name }}</span></p>
            <p>Email: <span>{{ $invoice->client->email }}</span></p>
            <p>Documento: <span>{{ $invoice->client->document }}</span></p>
            <p>Tipo documento: 
                <span>
                    @switch($invoice->client->type_id)
                        @case ('CE') Cedula de extranjeria @break
                        @case ('TI') Tarjeta de identidad @break
                        @default Cedula de ciudadania
                    @endswitch
                </span>
            </p>
            @else
            <p>Sin cliente asignado</p>
            @endif
        </div>
    </div>
</div>
<div class="card mb-3 p-3">
    <h3 class="text-center">Productos</h3>
    <div class="row">
        @foreach ($invoice->products as $product)
            <div class="col-12 col-sm-4 mb-3">
                <div class="card p-2">
                    <p>Producto: <span>{{ $product->product->name }}</span></p>
                    <p>Cantidad: <span>{{ $product->count }}</span></p>
                    <p>descuento: <span>{{ $product->discount}}%</span></p>
                    <p>Precio: <span>{{ number_format($product->gross_value, 0, ',', '.') }} COP</span></p>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="card p-3">
            <h3>Total</h3>
            <p>Cantidad de productos: <span>{{ $count_products }}</span></p>
            <p>Valor total sin impuestos: <span>{{ $total_gross }} COP</span></p>
            <p>Valor de descuento: <span>{{ $total_discount }} COP</span></p>
            <p>Valor total de iva: <span>{{ $total_iva }} COP</span></p>
            <p>Valor total con impuestos: <span>{{ $total }} COP</span></p>
        </div>
    </div>
</div>
@endsection