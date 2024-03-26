{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Editar Section de manera normal y Partes de manera livewire</h1>
@stop

@section('content')

    <x-admin-layout>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">


            <div class="col-span-1">

                <div class="card">
                    <div class="card-body">
                        {{-- METODO #1 - ACTUALIZAR DE FORMA TRADICIONAL Y NORMAL --}}
                        {{-- <form class="form-group" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"> --}}
                        <form class="form-group" method="POST" action="{{ route('admin.sections.update_section', [$section->id, $invitation]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="">
                                    Nombre de la section
                                </label>
                                <input type="text" class="form-control" name="name" id="name2"
                                    value="{{ $section->name }}">
                            </div>
                            <div>
                                <label for="">
                                    Description
                                </label>
                                <input type="text" class="form-control" name="description" id="desc"
                                    value="{{ $section->description }}">
                            </div>

                            <x-button class="mt-8">
                                Actualizar Section
                            </x-button>
                        </form>

                    </div>
                </div>

                {{-- Lista de partes livewire --}}
                <div class="card">
                    <div class="card-body">
                        <div>
                            @livewire('admin.sections.add-part', ['section' => $section])
                        </div>
                        @livewire('admin.sections.parts-index', ['section' => $section])
                    </div>
                </div>

            </div>


            <div class="col-span-1">
                <div class="card">
                    <div class="card-body">
                        {{-- OPEN --}}
                        {{-- @livewire('admin.sections.add-part', ['section' => $section]) --}}
                    </div>
                </div>
            </div>

        </div>

    </x-admin-layout>
@stop

@section('css')

@stop

@section('js')
    {{-- Livewire Sortable - Parte 1/5 --}}
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
@stop
