{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Create a Section</h1>
@stop

@section('content')
<x-admin-layout>

    <div class="card">
        <div class="card-body">

            {{-- METODO #1 - ACTUALIZAR DE FORMA TRADICIONAL Y NORMAL --}}
            {{-- <form class="form-group" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"> --}}
            <form class="form-group" method="POST" action="{{ route('admin.sections.store_sections',$invitation) }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">

                    <div class="col-span-1">
                        <div>
                            <label for="">
                                Nombre de la section
                            </label>
                            <input type="text" class="form-control" name="name" id="name2"
                                value="">
                        </div>
                        <div>
                            <label for="">
                                Description
                            </label>
                            <input type="text" class="form-control" name="description" id="desc"
                                value="">
                        </div>
                    </div>

                    <div class="col-span-1">
                        {{-- OPEN --}}
                    </div>

                </div>


                <button class="btn btn-primary mt-2" type="submit">
                    Create Section
                </button>
            </form>


        </div>
    </div>

</x-admin-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>console.log('Hi!'); </script>
@stop
