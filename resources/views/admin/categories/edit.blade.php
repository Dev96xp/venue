{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Editar Categoria</h1>
@stop

@section('content')

    {{-- Componente de Livewire para ADMIN --}}
    <x-admin-layout>

        @if (session('info'))
            <div class="alert alert-success">
                {{ session('info') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-6">

                        {{-- Category name --}}
                        <div class="form-group">
                            <label for="">
                                Nombre de la Categoria
                            </label>

                            <input type="text" class="form-control font-bold" name="name" id="name"
                                value="{{ $category->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- slug --}}
                        <div class="form-group">
                            <label for="">
                                Slug
                            </label>
                            {{-- MASTER CLASS - Errors, tienes informacion sobre el campo name ? si es SI,
                                 entonces contatena con la cadena is-invalid, si NO nada --}}
                            <input readonly type="text"
                                class="form-control . ($errors->has('slug') ? ' is-invalid' : '')" name="slug"
                                id="slug" value="{{ $category->slug }}">

                            @error('slug')
                                <strong class="text-xs text-red-600">{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="grid grid-cols-2 gap-6">
                        <div class="form-group">
                            <label for="">
                                Description
                            </label>
                            {{-- MASTER CLASS - Errors, tienes informacion sobre el campo name ? si es SI,
                                 entonces contatena con la cadena is-invalid, si NO nada --}}
                            <input type="text" class="form-control . ($errors->has('desc') ? ' is-invalid' : '')"
                                name="desc" id="" value="{{ $category->desc }}">

                            @error('desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">

                        </div>
                    </div>


                    <div class="grid grid-cols-6 gap-4">

                        {{-- Status --}}
                        {{-- MASTER CLASSS - Sobre un SELECT --}}
                        <div class="col-span-1 mb-4">
                            <label for="">
                                Status
                            </label>
                            <select class="form-control w-full" name="status">
                                @foreach ($statuses as $status)
                                    <option value={{ $status->id }}
                                        @if ($status->id == $category->status_category->id) selected="selected" @endif>{{ $status->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('status')
                                <strong class="text-xs text-red-600">{{ $message }}</strong>
                            @enderror
                        </div>

                        {{-- Type --}}
                        <div class="col-span-1 mb-4">
                            <label for="">
                                Type
                            </label>
                            <select class="form-control w-full" name="type_category_id">
                                {{-- Este es el valor por default --}}
                                {{-- <option value="" selected disabled>Type</option> --}}
                                @foreach ($types as $type)
                                    <option value={{ $type->id }}
                                        @if ($type->id == $category->type_category->id) selected="selected" @endif>{{ $type->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('type_category_id')
                                <strong class="text-xs text-red-600">{{ $message }}</strong>
                            @enderror
                        </div>


                        {{-- PARA LA IMAGENES LA OCULTE POR UN MOMENTO --}}

                        <div class="col-span-3 mb-4" style="display:none">

                        </div>

                    </div>

                    {{-- NOSE IMPORTANTE - Que la categoria por default este activa, ocultado  --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            {{-- {!! Form::checkbox('active', 1, null, ['class' => 'mr-2']) !!}
                            {!! Form::label('active', 'Subcategory ACTIVE status') !!} --}}
                        </div>
                        <div>

                        </div>
                    </div>

                    <br>
                    <label for="">
                        Seleccione, los detalles que se muestran en la pantalla del cliente, para esta categoria
                    </label>

                    {{-- Muestra los checkbox METODO 1 --}}
                    {{-- Aqui se recorren todos los details existentes --}}
                    @foreach ($details as $detail)
                        {{-- Aqui se revisa si la categoria contiene algun detail de toda la lista --}}
                        @php($x = false)
                        @foreach ($category->details as $detailx)
                            @if ($detail->id == $detailx->id)
                                {{-- Si existe alguno a la variable x se le dice, dandole el valor de true --}}
                                @php($x = true)
                            @endif
                        @endforeach

                        {{-- Aqui se muestran todos los permisos y adicionamente check-marks marcados
                            para los permisos que dependiendo del valor de x, anteriormente obtenido --}}
                        <div>
                            <label>
                                <input type="checkbox" id="queso" name="details[]" value="{{ $detail->id }}"
                                    @checked($x)>
                                {{ $detail->id }} - {{ $detail->name }}
                            </label>
                        </div>
                    @endforeach

                    <button class="btn btn-danger mt-2 bg-red-300" type="submit">
                        Actualizar category
                    </button>
                </form>

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
