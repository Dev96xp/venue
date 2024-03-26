{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL  --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.subcategories.create') }}">Crear Nueva
        Subcategoria</a>
    <h1>Lista de Subcategorias</h1>
    <p>Tiempo de entrega por categoria, es el tiempo que se usara para calcular en tiempo de entrega de los productos
        ordenados en linea.</p>

@stop

@section('content')

    {{-- Pone anuncio, si se realizo correctamente la actualizacion --}}
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Status</th>
                        <th>Marca</th>
                        <th class="text-right">Tiempo de entrega en dias por subcategoria</th>
                        <th colspan="2"></th> {{--  colspan="2" - Que ocupe dos espacios --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td>
                                {{ $subcategory->id }}
                            </td>
                            <td>
                                {{ $subcategory->name }}
                            </td>
                            <td class="px-6 py-auto whitespace-nowrap">
                                @if ($subcategory->active)
                                    <span
                                        class="px-2 text-sm inline-flex leading-5 font-semibold rounded-full bg-green-100 text-green-800 ">
                                        ACTIVE
                                    </span>
                                @else
                                    <span
                                        class="px-2 text-sm inline-flex leading-5font-semibold rounded-full bg-red-100 text-red-800">
                                        UNACTIVE
                                    </span>
                                @endif

                            </td>
                            <td>
                                @if ($subcategory->brand)
                                    {{ $subcategory->brand->name }}
                                @else
                                @endif

                            </td>

                            <td>
                                @if (isset($subcategory->features()->find(20)->pivot->days))
                                    <p class="text-right"><span
                                            class="font-bold">{{ $subcategory->features()->find(20)->pivot->days }}</span>
                                        dias</p>
                                @else
                                @endif
                            </td>

                            {{-- OJO,  width="10px" - Ayuda a mandar los botones al lado derecho --}}
                            <th width="10px">
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.subcategories.edit', $subcategory) }}">Editar</a>
                            </th>

                            {{-- DELETE CATEGORIA --}}
                            <th width="10px">
                                <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" type="submit">x</button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@stop
