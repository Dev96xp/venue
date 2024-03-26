{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Lista de secciones de una INVITACION</h1>
@stop

@section('content')

    <x-admin-layout>
        @if (session('info'))
            <div class="alert alert-success">
                {{ session('info') }}
            </div>
        @endif

        <div class="card">

            <div class="card-header">
                <a class="btn btn-primary mt-2" href="{{ Route('admin.sections.create_sections', $invitation) }}">Crear section</a>
            </div>

            <div class="card-body">
                <p class="text-2xl mb-4">Invitation: <span class="text-bold">{{ $invitation->name }}</span></p>
                {{-- Si por lo menos hay un registro se muestra la tabla --}}
                @if ($sections->count())

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Section name</th>
                                <th>Description</th>
                                <th>Image</th>
                                {{-- Contiene 2 columnas --}}
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($sections as $section)
                                <tr>
                                    <td>{{ $section->id }}</td>
                                    <td>
                                        <div>
                                            <div class="text-bold">{{ $section->name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $section->description }}</td>

                                    {{-- IMAGEN DEL PRODUCTO --}}
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12">

                                                {{-- Si existe la variable $section y ademas tiene una imagen relaicionada, que imprima, de lo contrario q lo ignore --}}
                                                @isset($section->images)
                                                    {{-- MASTER CLASS - $product->images->count() - Evita un error cuando no existen imagenes --}}
                                                    @if ($section->images->count())
                                                        <img id="picture"
                                                            class="h-12 w-12 rounded-full object-cover object-center inline-block"
                                                            src="{{ Storage::url($section->images->first()->url) }}"
                                                            alt="">
                                                    @else
                                                        {{-- Imagen por default en el caso de que no existiera una imagen relacionada al producto --}}
                                                        <img id="picture"
                                                            class="h-12 w-12 rounded-full object-cover object-center inline-block"
                                                            src="https://images.pexels.com/photos/6147134/pexels-photo-6147134.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                                                            alt="">
                                                    @endif
                                                @else
                                                    <img class="h-12 w-12 rounded-full object-cover object-center"
                                                        src="https://images.pexels.com/photos/6147134/pexels-photo-6147134.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                                                        alt="">
                                                @endisset

                                            </div>
                                        </div>
                                    </td>


                                    <td>{{ $section->image }}</td>

                                    {{-- BOTTON EDITAR PARTS --}}
                                    <td width="10px">
                                        <a class="btn btn-secondary"
                                            href="{{ route('admin.sections.edit_section', [$section, $invitation]) }}">Editar_Partes</a>
                                    </td>

                                    {{-- BOTTON BORRAR --}}
                                    {{-- RECUERDA QUE PARA BORRAR SE USA UN FORMULARIO NORMAL --}}

                                    {{-- PERMISO DE SEGURIDAD --}}
                                    <td width="10px">
                                        <form action="{{ route('admin.sections.destroy', $section) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Eliminar</button>
                                        </form>
                                    </td>

                                    {{-- BOTTON AGREGAR FOTOS --}}
                                    {{-- PERMISO DE SEGURIDAD --}}
                                    <td width="10px">
                                        <a class="btn btn-secondary"
                                            href="{{ route('admin.sections.select_files', $section) }}">Photos</a>
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No hay ningun role registrado</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>


                    {{-- EN EL CASO DE QUE NO HAYA REGISTROS --}}
                @else
                    <div class="px-6 py-4">
                        No hay ningun registro coincidente
                    </div>

                @endif

            </div>
        </div>
    </x-admin-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
