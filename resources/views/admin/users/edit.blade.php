{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Editar User</h1>
@stop

@section('content')

    {{-- <x-admin-layout> --}}

    <div class="card">
        <div class="card-body">
            {{-- METODO #1 - DE FORMA TRADICIONAL Y NORMAL --}}

            {{-- {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'put']) !!} --}}
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <label for="">
                        Nombre del Usuario
                    </label>
                    <input type="text" class="form-control" name="name" id="name2" value="{{ $user->name }}">
                </div>

                <br>

                {{-- {!! Form::checkbox($name, $value, $checked, [$options]) !!} --}}

                {{-- Muestra los checkbox METODO 1 --}}
                {{-- Aqui se recorren todos los permisos existentes --}}
                @foreach ($roles as $role)
                    {{-- Aqui se revisa si el roll contiene algun permiso de toda la lista --}}
                    @php($x = false)
                    @foreach ($user->roles as $rolex)
                        @if ($role->id == $rolex->id)
                            {{-- Si existe alguno a la variable x se le dice, dandole el valor de true --}}
                            @php($x = true)
                        @endif
                    @endforeach

                    {{-- Aqui se muestran todos los permisos y adicionamente check-marks marcados
                    para los permisos que dependiendo del valor de x, anteriormente obtenido --}}
                    <div>
                        <label>
                            <input type="checkbox" id="queso" name="roles[]" value="{{ $role->id }}"
                                @checked($x)>
                            {{ $role->id }} - {{ $role->name }}
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

@stop

@section('js')
    <script>

    </script>
@stop
