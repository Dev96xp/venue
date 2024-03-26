{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL  --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Add Brand</h1>
@stop


@section('content')

    <x-admin-layout>
        {{-- SE SOLICITA QUE SE INGRESE la inf. del nuevo departamento, por el usuario --}}
        <div class="card">
            <div class="card-body">

                <div class="grid grid-cols-3">
                    <div class="col-span-1">
                        <form action="{{ route('admin.brands.store') }}" method="post">

                            @csrf

                            {{-- Name --}}
                            <div class="mb-2">
                                <label for="">
                                    Nombre de la Marca
                                </label>
                                {{-- MASTER CLASS - Errors, tienes informacion sobre el campo name ? si es SI,
                                 entonces contatena con la cadena is-invalid, si NO nada --}}
                                <input type="text" class="form-control . ($errors->has('name') ? ' is-invalid' : '')"
                                    name="name" id="name">
                            </div>

                            {{-- Code --}}
                            <div class="mb-2">
                                <label for="">
                                    Code
                                </label>
                                {{-- MASTER CLASS - Errors, tienes informacion sobre el campo name ? si es SI,
                                 entonces contatena con la cadena is-invalid, si NO nada --}}
                                <input type="text" class="form-control . ($errors->has('code') ? ' is-invalid' : '')"
                                    name="code" id="code">
                            </div>

                            {{-- Time --}}
                            <div>
                                <label for="">
                                    Tiempo de entrega
                                </label>
                                {{-- MASTER CLASS - Errors, tienes informacion sobre el campo name ? si es SI,
                                 entonces contatena con la cadena is-invalid, si NO nada --}}
                                <input type="text" class="form-control . ($errors->has('time') ? ' is-invalid' : '')"
                                    name="time" id="">
                            </div>

                            <button class="btn btn-primary mt-4 bg-blue-300" type="submit">
                                Create brand
                            </button>

                        </form>
                    </div>

                    <div class="col-span-1">
                        {{-- NADA --}}
                    </div>
                    <div class="col-span-1">
                        {{-- NADA --}}
                    </div>
                </div>

            </div>
        </div>
    </x-admin-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/forms.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
