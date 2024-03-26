{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Crear nueva subcategoria</h1>
@stop

@section('content')

    {{-- Componente de Livewire para ADMIN --}}
    <x-admin-layout>

        <div class="card">
            <div class="card-body">

                <div class="grid grid-cols-3">
                    <div class="col-span-1">
                        <form action="{{ route('admin.subcategories.store') }}" method="post">

                            @csrf


                            {{-- Category --}}
                            <div class="col-span-1 mb-4">
                                <label for="">
                                    Category
                                </label>
                                <select class="form-control w-full" name="category_id">
                                    <option value="" selected disabled>Category</option>
                                    @foreach ($categories as $category)
                                        <option value={{ $category->id }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @error('category')
                                    <strong class="text-xs text-red-600">{{ $message }}</strong>
                                @enderror
                            </div>


                            {{-- Name --}}
                            <div class="mb-2">
                                <label for="">
                                    Nombre de la subcategory
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

                            {{-- Brand --}}
                            <div class="col-span-1 mb-4">
                                <label for="">
                                    Brand
                                </label>
                                <select class="form-control w-full" name="brand_id">
                                    <option value="" selected disabled>Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value={{ $brand->id }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>

                                @error('brand_id')
                                    <strong class="text-xs text-red-600">{{ $message }}</strong>
                                @enderror
                            </div>

                            <button class="btn btn-primary mt-4 bg-blue-300" type="submit">
                                Crear Subcatery
                            </button>

                        </form>

                    </div>
                    <div class="col-span-1">
                    </div>
                    <div class="col-span-1">
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
@stop

@section('js')
@stop
