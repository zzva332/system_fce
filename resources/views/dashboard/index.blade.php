@extends('layout')

@section('title', 'Page Title')

@section('content')

<h1 class="h2">Resumen de procesos</h1>
<hr/>

<!-- contenido -->
<div class="row sumary-info">
    <div class="col-12 col-md col-sm-6 mb-4">
        <div class="card p-2 d-flex justify-content-center align-items-center">
            <span class="h1"><i class="bi bi-clock"></i></span>
            <span class="h2">{{ $totalInvoiceToday }}</span>
            <span>Facturacion de hoy</span>
        </div>
    </div>
    <div class="col-12 col-md col-sm-6 mb-4">
        <div class="card p-2 d-flex justify-content-center align-items-center">
            <span class="h1"><i class="bi bi-clock"></i></span>
            <span class="h2">93</span>
            <span>Facturacion semana pasada</span>
        </div>
    </div>
    <div class="col-12 col-md col-sm-6 mb-4">
        <div class="card p-2 d-flex justify-content-center align-items-center">
            <span class="h1"><i class="bi bi-clock"></i></span>
            <span class="h2">{{$totalLowInventory}}</span>
            <span>Inventario por agotarse</span>
        </div>
    </div>
</div>

<h2 class="h3">Transacciones recientes</h2>
<hr>
<table class="table table-responsive">
    <thead>
        <tr>
            <td>ID</td>
            <td>Referencia</td>
            <td>Cliente</td>
            <td>Productos</td>
            <td>Creacion</td>
            <td>Modificacion</td>

        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $item)
            <tr>
                <td><a href="{{ route('invoices.show', $item->id) }}">#{{ $item->id }}</a></td>
                <td>{{ substr($item->reference, 0, 8) }}...{{ substr($item->reference, -8) }}</td>
                <td>
                    @if ($item->client)
                        {{ $item->client->name }}
                    @else
                        ---
                    @endif
                </td>
                <td>{{ count($item->products) }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection