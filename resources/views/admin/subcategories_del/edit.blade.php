{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')    
<a class="btn btn-secondary btn-sm float-right" href="{{route('admin.subcategories.create')}}">Crear Nueva Subcategoria</a>
    <h1>Editar Subcategoria</h1>
@stop

@section('content')

    {{-- Componente de Livewire para ADMIN --}}
    <x-adminx-layout>

        {{-- Pone anuncio, si se realizo correctamente la actualizacion --}}
        @if (session('info'))
            <div class="alert alert-success">
                {{ session('info') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                {!! Form::model($subcategory, ['route' => ['admin.subcategories.update', $subcategory], 'method' => 'put', 'files' => true]) !!}

                <div class="grid grid-cols-4 gap-6">

                    <div class="form-group col-span-2">
                        {!! Form::label('category_id', 'Categoria/Departamento') !!}
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">

                    <div class="form-group">
                        {!! Form::label('name', 'Subcategory') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la subcategoria']) !!}

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        {!! Form::label('slug', 'Slug de la subcategoria') !!}
                        {!! Form::text('slug', null, ['readonly' => 'readonly', 'class' => 'form-control' . ($errors->has('slug') ? ' border-red-600' : '')]) !!}

                        @error('slug')
                            <strong class="text-xs text-red-600">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">                        
                    @if ($subcategory->features()->count())
                        {{-- Fecha de entrega, en dias --}}
                        <div class="form-group">
                            {!! Form::label('days', 'Dias para entrega de producto') !!}
                            {!! Form::text('days', $subcategory->features()->find(20)->pivot->days, ['class' => 'form-control', 'placeholder' => 'Numero de dias para la entrega']) !!}
                            {{-- $product->subcategory->features()->find(20)->pivot->days --}}
                            @error('days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div> 
                            {!! Form::checkbox('active', $subcategory->active, null, ['class' => 'mr-2']) !!}
                            {!! Form::label('active', 'Subcategory ACTIVE Status') !!}                            
                        </div>

                    @else
                        {{-- Fecha de entrega, en dias --}}
                        <div class="form-group">
                            {!! Form::label('days', 'Dias para entrega de producto') !!}
                            {!! Form::text('days', 0, ['class' => 'form-control', 'placeholder' => 'Numero de dias para la entrega']) !!}
                            {{-- $product->subcategory->features()->find(20)->pivot->days --}}
                            @error('days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div> 
                            {!! Form::checkbox('active', $subcategory->active, null, ['class' => 'mr-2']) !!}
                            {!! Form::label('active', 'Subcategory ACTIVE Status') !!}                            
                        </div>
                    @endif


                </div>




                <div class="grid grid-cols-4 gap-6">
                    <div class="form-group col-span-2">

                        {!! Form::label('name', 'Seleccione, los detalles que se muestran en la pantalla del cliente') !!}

                        {{-- Muestra los checkbox --}}
                        {{-- PASO 1 - Despliega las caracteristicas(features), EN FORMA DE CHECKBOX
                                      que estan guardadas en una tabla: (FEATURES),                            
                             PASO 2 - UNA VEZ EN EL FORMULARIO, EL USUARIO LA MARCA COMO SELECIONADAS
                             PASO 3 - Y SE EJECUTA EL METODO UPDATE, PARA GUARDAR LAS QUE SOLO FUERON SELECIONADAS
                                      EN LA TABLA (FEATURE_SUBCATEGORY)  --}}
                        @foreach ($features as $feature)
                            <div>
                                {{-- Ojo aqui se agrego un label --}}
                                <label>
                                    {!! Form::checkbox('features[]', $feature->id, null, ['class' => 'mr-1']) !!}
                                    {{ $feature->name }}
                                </label>
                                {{-- {!! Form::text('days', $features[4]->days, ['class' => 'form-control', 'placeholder' => 'Numero de dias para la entrega']) !!} --}}
                            </div>
        
                        @endforeach

                    </div>


                    {{-- SELECIONAR IMAGENES (VARIAS SIMULTANEAMENTE) --}}
                    <div class="grid grid-cols-2 gap-4">
                        <h1 class="text-2xl font-bold mt-8 mb-2">Imagen dela Subcategoria</h1>

                        {{-- PARTE 1 - DESPLIEGA IMAGENES DEL PRODUCTO --}}
                        <figure>
                            {{-- IMAGEN ACTUAL DEL PRODUCTO --}}
                            @isset($subcategory->images)
                                @foreach ($subcategory->images as $item)
                                    <img id="picture" class=" h-48 object-cover object-center inline-block"
                                        src="{{ Storage::url($item->url) }}" alt="">
                                @endforeach            
                            @else
                                <img id="picture" class="w-full h-64 object-cover object-center"
                                    src="https://images.pexels.com/photos/6147134/pexels-photo-6147134.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                                    alt="">
                            @endisset
                        </figure>
                        
                        {{-- PARTE 2 - CAPTURA DE IMAGENES (VARIAS SIMULTANEAMENTE)**** --}}
                        {{-- a) ('multiple'=>'multiple') - Se usa para poder selecionar varia imagenes --}}
                        {{-- b) ( 'file[]' ) - Se le agrega [], para convertilo en un arreglo de archivos y aceptar varios archivos --}}
                        <div>
                            <p class="mb-2">Presiona el boton y seleciona las imagenes a capturar, una vez selecionadas</p>
                            {!! Form::file('file[]', ['id' => 'file', 'multiple' => 'multiple', 'class' => 'form-input w-full' . ($errors->has('file') ? ' border-red-600' : ''), 'id' => 'file', 'accept' => 'images/*']) !!}
                            @error('file')
                                <strong class="text-xs text-red-600">{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>

                </div>

                {!! Form::submit('Actualizar subcategoria', ['class' => 'btn btn-primary']) !!}


                {!! Form::close() !!}

                
            </div>

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
