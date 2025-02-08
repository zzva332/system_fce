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
            <span class="h2">100</span>
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

<h2 class="h3">Transacciones</h2>
<hr>

@endsection