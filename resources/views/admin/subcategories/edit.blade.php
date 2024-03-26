{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.subcategories.create') }}">Crear Nueva
        Subcategoria</a>
    <h1>Editar Subcategoria</h1>
@stop

@section('content')

    {{-- Componente de Livewire para ADMIN --}}
    <x-admin-layout>

        {{-- Pone anuncio, si se realizo correctamente la actualizacion --}}
        @if (session('info'))
            <div class="alert alert-success">
                {{ session('info') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.subcategories.update', $subcategory) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <div class="grid grid-cols-4 gap-6">

                        {{-- Category --}}
                        <div class="form-group col-span-2">
                            <label for="">
                                Category
                            </label>
                            <select class="form-control w-full" name="category_id">
                                {{-- Este es el valor por default --}}
                                {{-- <option value="" selected disabled>Type</option> --}}
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}
                                        @if ($category->id == $subcategory->category->id) selected="selected" @endif>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('type_category_id')
                                <strong class="text-xs text-red-600">{{ $message }}</strong>
                            @enderror

                        </div>
                        {{-- Brand --}}
                        <div class="form-group col-span-2 lg:col-span-1">
                            <label for="">
                                Brand
                            </label>
                            <select class="form-control w-full" name="brand_id">
                                {{-- Este es el valor por default --}}
                                {{-- <option value="" selected disabled>Pick an option</option> --}}
                                @foreach ($brands as $brand)
                                    <option value={{ $brand->id }}
                                        @if ($brand->id == $subcategory->brand->id) selected="selected" @endif>{{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('brand_id')
                                <strong class="text-xs text-red-600">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">

                        {{-- Subcategory name --}}
                        <div class="form-group">
                            <label for="">
                                Nombre de la Subcategory
                            </label>

                            <input type="text" class="form-control font-bold" name="name" id="name"
                                value="{{ $subcategory->name }}">
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
                                id="slug" value="{{ $subcategory->slug }}">

                            @error('slug')
                                <strong class="text-xs text-red-600">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    {{-- Dias y Status active SE QUEDA PENDIENTE NO TRABAJA --}}
                    <div class="grid grid-cols-2 gap-6">

                        @if ($subcategory->features()->count())
                            @if (isset($subcategory->features()->find(20)->pivot->days))
                                {{-- Subcategory name --}}
                                <div class="form-group">
                                    <label for="">
                                        Dias para entregar el producto, chechar option-20(20 - days1) para efectos s1
                                    </label>

                                    <input type="text" class="form-control font-bold" name="days" id="days"
                                        value="{{ $subcategory->features()->find(20)->pivot->days }}">
                                    @error('days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="">
                                        Dias para entregar el producto, chechar option-20(20 - days1) para efectos s2
                                    </label>

                                    <input type="text" class="form-control font-bold" name="days" id="days"
                                        value="0">
                                    @error('days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                        @else
                            <div class="form-group">
                                <label for="">
                                    Dias para entregar el producto, chechar option-20(20 - days1) para efectos s3
                                </label>

                                <input type="text" class="form-control font-bold" name="days" id="days"
                                    value="0">
                                @error('days')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        @endif


                        <div class="my-auto">
                            <input type="checkbox" name="jamon" value={{ $subcategory->active }}>
                            <label for="active"> Subcategory ACTIVE Status</label><br>
                        </div>

                    </div>

                    {{-- Features --}}
                    <div class="grid grid-cols-4 gap-6">
                        <div class="form-group col-span-2">
                            <br>
                            <label for="">
                                Seleccione, los detalles que se muestran en la pantalla del cliente, para esta categoria
                            </label>

                            {{-- Muestra los checkbox --}}
                            {{-- PASO 1 - Despliega las caracteristicas(features), EN FORMA DE CHECKBOX
                                      que estan guardadas en una tabla: (FEATURES),
                             PASO 2 - UNA VEZ EN EL FORMULARIO, EL USUARIO LA MARCA COMO SELECIONADAS
                             PASO 3 - Y SE EJECUTA EL METODO UPDATE, PARA GUARDAR LAS QUE SOLO FUERON SELECIONADAS
                                      EN LA TABLA (FEATURE_SUBCATEGORY)  --}}

                            {{-- Muestra los checkbox METODO 1 --}}
                            {{-- Aqui se recorren todos los details existentes --}}
                            @foreach ($features as $feature)
                                {{-- Aqui se revisa si la categoria contiene algun detail de toda la lista --}}
                                @php($x = false)
                                @foreach ($subcategory->features as $featurex)
                                    @if ($feature->id == $featurex->id)
                                        {{-- Si existe alguno a la variable x se le dice, dandole el valor de true --}}
                                        @php($x = true)
                                    @endif
                                @endforeach

                                {{-- Aqui se muestran todos los permisos y adicionamente check-marks marcados
                                    para los permisos que dependiendo del valor de x, anteriormente obtenido --}}
                                <div>
                                    <label>
                                        <input type="checkbox" id="queso" name="features[]" value="{{ $feature->id }}"
                                            @checked($x)>
                                        {{ $feature->id }} - {{ $feature->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button class="btn btn-danger mt-2 bg-red-300" type="submit">
                        Actualizar subcategory
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
    <link rel="stylesheet" href="/css/forms.css">
@stop

@section('js')
@stop
