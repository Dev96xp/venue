{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Crear nueva subcategoria</h1>
@stop

@section('content')

    {{-- Componente de Livewire para ADMIN --}}
    <x-adminx-layout>

        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'admin.subcategories.store']) !!}

                <div class="grid grid-cols-4 gap-6">

                    <div class="form-group col-span-1">
                        {!! Form::label('category_id', 'Categoria/Departamento') !!}
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                    </div>

                </div>
                
                <div class="grid grid-cols-2 gap-6">

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la subcategoria']) !!}
                                                                    {{-- form-input block w-full mt-1 --}}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'Slug del curso') !!}
                        {!! Form::text('slug', null, ['readonly' => 'readonly', 'class' => 'form-control' . ($errors->has('slug') ? ' border-red-600' : '')]) !!}

                        @error('slug')
                            <strong class="text-xs text-red-600">{{ $message }}</strong>
                        @enderror
                    </div>

                </div>
                {!! Form::submit('Crear subcategoria', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}


                {{-- Slot con nombre - usado PARA RENDERIZAR EN LA PLANTILLA principal --}}
                
                <x-slot name="js">

                    {{-- PARA MEJORAR EL EDITOR DE TEXTO, DEL CAMPO DESCRIPTION --}}
                    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>

                    {{-- PARA CAMBIAR LAS IMAGENES DEL PRODUCTO EN TIEMPO REAL, SOBRE EL FORMULARIO Y
                         TAMBIEN PARA HACER USO DEL SLUG --}}
                    {{-- Desde aqui se controlan las imagenes, el editor de texto, slug ... --}}
                    <script src="{{ asset('js/admin/products/subcategory.js') }}"></script>                    
                </x-slot>

            </div>
        </div>
    </x-adminx-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
