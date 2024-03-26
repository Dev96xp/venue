{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL  --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Editar Compañia</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="grid grid-cols-3">
                <div class="col-span-1">
                    <form action="{{ route('admin.brands.update', $brand) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Category name --}}
                        <div class="form-group">
                            <label for="">
                                Nombre de la Marca
                            </label>

                            <input type="text" class="form-control font-bold" name="name" id="name"
                                value="{{ $brand->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Code --}}
                        <div class="form-group">
                            <label for="">
                                Code
                            </label>

                            <input type="text" class="form-control font-bold" name="code" id="code"
                                value="{{ $brand->code }}">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Time --}}
                        <div class="form-group">
                            <label for="">
                                Time
                            </label>

                            <input type="text" class="form-control font-bold" name="time" id="time"
                                value="{{ $brand->time }}">
                            @error('time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-danger mt-2 bg-red-300" type="submit">
                            Actualizar marca
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/forms.css">
@stop

@section('js')
@stop
