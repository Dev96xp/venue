{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Lista de roles</h1>
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
            <a class="btn btn-primary mt-2" href="{{ route('admin.roles.create') }}">Crear role</a>
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

                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>
                                <div>
                                    <div class="text-bold">{{ $role->name }}</div>
                                    <div class="text-blue">
                                        @foreach ($role->permissions as $permission)
                                            {{ $permission->name }},
                                        @endforeach
                                    </div>
                                </div>
                            </td>

                            {{-- BOTTON EDITAR --}}
                            <td width="10px">
                                <a class="btn btn-secondary" href="{{ route('admin.roles.edit', $role) }}">Editar</a>
                            </td>

                            {{-- BOTTON BORRAR --}}
                            {{-- RECUERDA QUE PARA BORRAR SE USA UN FORMULARIO NORMAL --}}

                            @can('Eliminar role')
                                {{-- PERMISO DE SEGURIDAD --}}
                                <td width="10px">
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
