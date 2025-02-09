
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Lista de facturas</h1>
    <hr/>
</div>
<a href="{{ route('invoices.create') }}" class="btn btn-dark mb-2"><i class="bi bi-plus-lg"></i> Agregar</a>
<table class="table table-responsive">
    <thead>
        <tr>
            <td>ID</td>
            <td>Numero factura</td>
            <td>Categoria</td>
            <td>Cliente</td>
            <td>Fecha</td>
            <td>Opciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td> {{ substr($item->reference, 0, 8) }}...{{ substr($item->reference, -8) }}</td>
                <td>{{ $item->category_name }}</td>
                <td>
                    @if ($item->client)
                        {{ $item->client->name }}
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($item->update_at)->format('d-m-Y H:i:s') }}</td>
                <td>
                    <a href="{{ route('invoices.edit', $item->id) }}" class="btn btn-dark btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <!-- <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#itemDelete"><i class="bi bi-trash3"></i></a> -->
                    <form action="{{ route('invoices.destroy', $item->id) }}" method="post" class="d-inline-block">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

