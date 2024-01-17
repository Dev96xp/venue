{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Crear nuevo role</h1>
@stop

@section('content')

    {{-- <x-admin-layout> --}}

        <div class="card">
            <div class="card-body">
                {{-- METODO #1 - DE FORMA TRADICIONAL Y NORMAL --}}
                {{-- 'route' => 'admin.roles.store' --}}

                <form action="{{ route('admin.roles.store') }}" method="post">

                    @csrf

                    <div>
                        <label for="">
                            Nombre del Role
                        </label>
                        {{-- MASTER CLASS - Errors, tienes informacion sobre el campo name ? si es SI,
                             entonces contatena con la cadena is-invalid, si NO nada --}}
                        <input type="text" class="form-control . ($errors->has('name') ? ' is-invalid' : '')" name="name"
                            id="">
                    </div>

                    @error('name')
                        <span class="invalid-feedback">
                            <strong>
                                {{ $message }}
                            </strong>
                        </span>
                    @enderror
                    <br>

                    {{-- Muestra los checkbox METODO 1 --}}
                    @foreach ($permissions as $permission)
                        <div>
                            <label>
                                <input type="checkbox" id="queso" name="permissions[]" value="{{ $permission->id }}">
                                {{ $permission->id }} - {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach

                    <button class="btn btn-primary mt-2" type="submit">
                        Crear Role
                    </button>
                </form>

            </div>
        </div>

    {{-- </x-admin-layout> --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
