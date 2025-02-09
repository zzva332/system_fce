
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
                <td><a href="{{ route('invoices.show', $item->id) }}">#{{ $item->id }}</a></td>
                <td> {{ substr($item->reference, 0, 8) }}...{{ substr($item->reference, -8) }}</td>
                <td>{{ $item->category_name }}</td>
                <td>
                    @if ($item->client)
                        {{ $item->client->name }}
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($item->update_at)->format('d-m-Y H:i:s') }}</td>
                <td>
                    <a href="{{ route('invoices.show', $item->id) }}" class="btn btn-dark btn-sm"><i class="bi bi-eye-fill"></i></a>
                    <a href="#" class="btn btn-dark btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('invoices.edit', $item->id) }}">Editar</a></li>
                        <li><a class="dropdown-item" href="#">imprimir</a></li>
                        <li><a class="dropdown-item disabled" data-bs-toggle="modal" data-bs-target="#itemSendEmail" href="#">Enviar a correo</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('invoices.destroy', $item->id) }}" method="post" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button class="dropdown-item @empty($item->products) disabled  @endempty"><i class="bi bi-trash3"></i> Remover</button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $invoices->links() }}
</div>
@endsection

