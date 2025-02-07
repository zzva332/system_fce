
@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="mb-4">
    <h1 class="h2">Lista de usuarios del sistema</h1>
    <hr/>
</div>
<a href="{{ route('users.create') }}" class="btn btn-dark mb-2"><i class="bi bi-plus-lg"></i> Agregar</a>
<table class="table table-responsive">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nombre completo</td>
            <td>Email</td>
            <td>Rol</td>
            <td>Opciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>Administrador</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-dark btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <!-- <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#itemDelete"><i class="bi bi-trash3"></i></a> -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline-block">
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

