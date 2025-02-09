
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Lista de productos</h1>
    <hr/>
</div>
<a href="{{ route('products.create') }}" class="btn btn-dark mb-2"><i class="bi bi-plus-lg"></i> Agregar</a>
<table class="table table-responsive">
    <thead>
        <tr>
            <td>ID</td>
            <td>Codigo</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Descripcion</td>
            <td>Opciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item)
            <tr>
                <td><a href="{{ route('products.edit', $item->id) }}">{{ $item->id }}</a></td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="{{ route('products.edit', $item->id) }}" class="btn btn-dark btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <!-- <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#itemDelete"><i class="bi bi-trash3"></i></a> -->
                    <form action="{{ route('products.destroy', $item->id) }}" method="post" class="d-inline-block">
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

