{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>THE PALACE HALL Inc</h1>
@stop

@section('content')

    <p class="mb-10 text-lg text-right">Welcome to Nucleous Data Industries 2024: {{ Auth::user()->name }}</p>

    <x-admin-layout>

        <div id="container">
            {{-- Lista de users --}}
            <div class="grid grid-cols-6">
                <div class="col-span-2">

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Administrators</th>
                                    {{-- Contiene 2 columnas --}}
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($users as $user)
                                    <tr wire:key="queso-{{ $user->id }}">
                                        <td>{{ $user->id }} - {{ $user->phone }}</td>
                                        <td>{{ $user->name }}
                                            <div class="text-blue-500">
                                                {{ $user->store->name }}
                                            </div>
                                        </td>
                                        {{-- <td>{{ $user->store->name }}</td> --}}
                                        <td class="px-6 py-1 text-md font-medium">
                                            @livewire('admin.dashboard.edit-user', ['user' => $user], key($user->id))
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No hay ningun user registrado</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="col-span-4">
                    {{-- Nada --}}
                </div>
            </div>
        </div>

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
