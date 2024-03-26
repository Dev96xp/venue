@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.brands.create')}}">Nueva Marca</a>
    <h1>Brands / Marcas</h1>

@stop

@section('content')

    {{-- COMPONENTE DE LIVEWIRE - LISTA DE USUARIOS --}}
    {{-- Ojo se usa un guion en livewire --}}
    {{-- @livewire('admin.sales-pos', ['user' => $user], key('sales-pos' . $user->id)) --}}

    @if (session('info'))
    <div class="alert alert-success">
        {{session('info')}}
    </div>
    @endif


    <div class="card">
        <div class="ml-4 mt-4">
            NOTE:
            ONLINE - Significa que SOLO, estas marcas se muestran EN LINEA al publico para la venta.
        </div>
        <div class="ml-4 mt-2">
            NOTE:
            TIEMPO DE ENTREGA - Es el tiempo que aproximadamente tarda en llegar un producto de esta compañia al almacen.
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Company</th>
                        <th>Tiempo de entrega</th>
                        <th>Status</th>
                        <th>Online status</th>
                        <th colspan="2"></th>  {{--  colspan="2" - Que ocupe dos espacios --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>
                                {{$brand->id}}
                            </td>
                            <td>
                                {{$brand->code}}
                            </td>
                            <td>
                                {{$brand->name}}
                            </td>
                            <td>
                                {{$brand->time}}
                            </td>
                            <td>
                                {{$brand->status}}
                            </td>

                            <td>
                                @if ($brand->categories->count() > 0)
                                    <div class="text-green">
                                        ONLINE
                                    </div>

                                @else

                                @endif


                            </td>
                            {{-- OJO,  width="10px" - Ayuda a mandar los botones al lado derecho --}}
                            <th width="10px" class="p-1">
                                <a class="btn btn-primary btn-sm" href="{{route('admin.brands.edit', $brand)}}">Editar</a>
                            </th>
                            <th width="10px" class="p-1">
                                <form action="{{route('admin.brands.destroy', $brand)}}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>

                                </form>
                            </th>
                        </tr>

                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>console.log('Hi!'); </script>
@stop

