{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Editar Role</h1>
@stop

@section('content')

{{-- <x-admin-layout> --}}

    <div class="card">
        <div class="card-body">
            {{-- METODO #1 - DE FORMA TRADICIONAL Y NORMAL --}}

            {{-- {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'put']) !!} --}}
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="">
                        Nombre del Role
                    </label>
                    <input type="text" class="form-control" name="name"
                        id="name2" value="{{ $role->name }}">
                </div>

                <br>

                {{-- {!! Form::checkbox($name, $value, $checked, [$options]) !!} --}}

                {{-- Muestra los checkbox METODO 1 --}}
                @foreach ($permissions as $permission)
                    @php($x = false)
                    @foreach ($role->permissions as $permissionx)

                        @if ($permission->id == $permissionx->id)
                            @php($x = true)
                        @endif
                    @endforeach

                    <div>
                        <label>
                            <input type="checkbox" id="queso" name="permissions[]" value="{{ $permission->id }}"
                                @checked($x)>
                            {{ $permission->id }} - {{ $permission->name }}
                        </label>
                    </div>

                @endforeach

                <button class="btn btn-primary mt-2" type="submit">
                    Actualizar Role
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
