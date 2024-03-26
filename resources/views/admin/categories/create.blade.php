{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Crear Nueva categoria</h1>
@stop

@section('content')

    {{-- Componente de Livewire para ADMIN --}}
    <x-admin-layout>

        <div class="card">
            <div class="card-body">

                <div class="grid grid-cols-3">
                    <div class="col-span-1">
                        <form action="{{ route('admin.categories.store') }}" method="post">

                            @csrf

                            {{-- Name --}}
                            <div class="mb-2">
                                <label for="">
                                    Nombre de la category
                                </label>
                                {{-- MASTER CLASS - Errors, tienes informacion sobre el campo name ? si es SI,
                                     entonces contatena con la cadena is-invalid, si NO nada --}}
                                <input type="text" class="form-control . ($errors->has('name') ? ' is-invalid' : '')"
                                    name="name" id="name">
                            </div>

                            {{-- Slug --}}
                            <div class="mb-2">
                                <label for="">
                                    Slug
                                </label>
                                {{-- MASTER CLASS - Errors, tienes informacion sobre el campo name ? si es SI,
                                     entonces contatena con la cadena is-invalid, si NO nada --}}
                                <input readonly type="text"
                                    class="form-control . ($errors->has('slug') ? ' is-invalid' : '')" name="slug"
                                    id="slug">
                            </div>

                            {{-- Description --}}
                            <div>
                                <label for="">
                                    Description
                                </label>
                                {{-- MASTER CLASS - Errors, tienes informacion sobre el campo name ? si es SI,
                                     entonces contatena con la cadena is-invalid, si NO nada --}}
                                <input type="text" class="form-control . ($errors->has('desc') ? ' is-invalid' : '')"
                                    name="desc" id="">
                            </div>


                            <div class="grid-col-2 gap-4">

                                <div class="span-col-1">
                                    {{-- Type --}}
                                    <label for="">
                                        Type
                                    </label>
                                    <select class="form-control w-full" name="type">
                                        {{-- Este es el valor por default --}}
                                        <option value="" selected disabled>Type</option>
                                        @foreach ($types as $type)
                                            <option value={{ $type->id }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('type')
                                        <strong class="text-xs text-red-600">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="span-col-1">
                                    {{-- Status --}}
                                    {{-- MASTER CLASSS - Sobre un SELECT --}}
                                    <div class="col-span-1 mb-4">
                                        <label for="">
                                            Status
                                        </label>
                                        <select class="form-control w-full" name="status">
                                            <option value="" selected disabled>Status</option>
                                            @foreach ($statuses as $status)
                                                <option value={{ $status->id }}>{{ $status->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <strong class="text-xs text-red-600">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary mt-4 bg-blue-300" type="submit">
                                Crear Category
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

        <script>
            //Slug automático
            document.getElementById("name").addEventListener('keyup', slugChange);

            function slugChange() {

                name = document.getElementById("name").value;
                document.getElementById("slug").value = slug(name);

            }

            function slug(str) {
                var $slug = '';
                var trimmed = str.trim(str);
                $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
                replace(/-+/g, '-').
                replace(/^-|-$/g, '');
                return $slug.toLowerCase();
            }
        </script>
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
