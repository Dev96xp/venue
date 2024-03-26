@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Invitations</h1>
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
            <a class="btn btn-primary mt-2" href="{{ route('admin.invitations.create') }}">Crear invitation</a>
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
                    @forelse ($invitations as $invitation)
                        <tr>
                            <td>{{ $invitation->id }}</td>

                            <td>
                                <div>
                                    <div class="text-bold">{{ $invitation->name }}</div>
                                    {{-- <div class="text-blue">
                                        {{ $invitation->user()->name }}
                                    </div> --}}
                                </div>
                            </td>

                            {{-- BOTTON EDITAR --}}
                            <td width="10px">
                                <a class="btn btn-secondary"
                                    href="{{ route('admin.sections.edit_sections', $invitation) }}">Editar_Sections</a>
                            </td>

                            {{-- BOTTON BORRAR --}}
                            {{-- RECUERDA QUE PARA BORRAR SE USA UN FORMULARIO NORMAL --}}

                            @can('Eliminar role')
                                {{-- PERMISO DE SEGURIDAD --}}
                                <td width="10px">
                                    <form action="{{ route('admin.invitations.destroy', $invitation) }}" method="POST">
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
