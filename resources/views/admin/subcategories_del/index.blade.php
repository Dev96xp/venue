{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL  --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.subcategories.create')}}">Crear Nueva Subcategoria</a>
    <h1>Lista de Subcategorias</h1>
@stop

@section('content')

    {{-- Pone anuncio, si se realizo correctamente la actualizacion --}}
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>  {{--  colspan="2" - Que ocupe dos espacios --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td>
                                {{$subcategory->id}}
                            </td>
                            <td>
                                {{$subcategory->name}}
                            </td>    

                            {{-- OJO,  width="10px" - Ayuda a mandar los botones al lado derecho --}}
                            <th width="10px">
                                <a class="btn btn-primary btn-sm" href="{{route('admin.subcategories.edit', $subcategory)}}">Editar</a>
                            </th>

                            {{-- DELETE CATEGORIA --}}
                            <th width="10px">
                                <form action="{{route('admin.subcategories.destroy', $subcategory)}}" method="POST">
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
