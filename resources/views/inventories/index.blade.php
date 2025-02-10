
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Lista de inventarios</h1>
    <hr/>
</div>
<a href="{{ route('inventories.create') }}" class="btn btn-dark mb-2"><i class="bi bi-plus-lg"></i> Agregar</a>
<table class="table table-responsive">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nombre producto</td>
            <td>Precio base</td>
            <td>Stock</td>
            <td>Iva</td>
            <td>Descuento</td>
            <td>Opciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventories as $item)
            <tr>
                <td><a href="{{ route('inventories.edit', $item->id) }}">#{{ $item->id }}</a></td>
                <td>{{ $item->product->name }}</td>
                <td>{{ number_format($item->product->price, 0, ',', '.') }} COP</td>
                <td>{{ $item->stock }}</td>
                <td>{{ $item->iva }}%</td>
                <td>{{ $item->discount }}%</td>
                <td>
                    <a href="{{ route('inventories.edit', $item->id) }}" class="btn btn-dark btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <!-- <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#itemDelete"><i class="bi bi-trash3"></i></a> -->
                    <form action="{{ route('inventories.destroy', $item->id) }}" method="post" class="d-inline-block">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $inventories->links() }}
</div>
@endsection

