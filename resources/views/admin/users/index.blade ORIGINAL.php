{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

    {{-- Si existe la VARIEBLE DE SESSION llamada: info, que se realice, de lo contrario que se ignore --}}
    @if (session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>Exito!</strong>{{ session('info') }}
        </div>
    @endif



    <div class="card">

        <div class="card-header">
            <a class="btn btn-primary mt-2" href="{{ route('admin.users.create') }}">Crear user</a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        {{-- Contiene 2 columnas --}}
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div>
                                    <div class="text-bold">{{ $user->name }}</div>
                                    <div class="text-blue">
                                        @foreach ($user->invitations as $invitation)
                                        [{{ $invitation->id }}] - {{ $invitation->name }},
                                        @endforeach
                                    </div>
                                </div>
                            </td>

                            {{-- BOTTON EDITAR --}}
                            <td width="10px">
                                <a class="btn btn-secondary" href="{{ route('admin.users.edit', $user) }}">Editar</a>
                            </td>

                            {{-- BOTTON BORRAR --}}
                            {{-- RECUERDA QUE PARA BORRAR SE USA UN FORMULARIO NORMAL --}}

                            @can('Eliminar role')
                                {{-- PERMISO DE SEGURIDAD --}}
                                <td width="10px">
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            @endcan

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay ningun role registrado</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
