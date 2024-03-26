@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Lista de Categorias</h1>
@stop

@section('content')

    {{-- Componente de Livewire para ADMIN --}}
    <x-admin-layout>
        @if (session('info'))
            <div class="alert alert-success">
                {{ session('info') }}
            </div>
        @endif
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-1">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.categories.create') }}">Nueva Categoria</a>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th colspan="2"></th> {{-- colspan="2" - Que ocupe dos espacios --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->id }}
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>

                                        <td class="px-6 py-auto whitespace-nowrap">

                                            @switch($category->status)
                                                @case(1)
                                                    <span
                                                        class="px-2 text-sm inline-flex leading-5 font-semibold rounded-full bg-green-100 text-green-800 ">
                                                        {{ $category->status_category->name }}
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span
                                                        class="px-2 text-sm inline-flex leading-5font-semibold rounded-full bg-red-100 text-red-800">
                                                        {{ $category->status_category->name }}
                                                    </span>
                                                @break

                                                @case(3)
                                                    <span
                                                        class="px-2 text-sm inline-flex leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        {{ $category->status_category->name }}
                                                    </span>
                                                @break

                                                @default
                                            @endswitch


                                        </td>

                                        <td class="whitespace-nowrap">
                                            {{ $category->type_category->name }}
                                        </td>

                                        {{-- OJO,  width="10px" - Ayuda a mandar los botones al lado derecho --}}
                                        <th width="10px">
                                            <a class="btn btn-primary btn-sm py-0 px-2"
                                                href="{{ route('admin.categories.edit', $category) }}">Editar</a>
                                        </th>
                                        <th width="10px">
                                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger bg-red-600 btn-sm py-0 px-2 font-normal"
                                                    type="submit">x</button>

                                            </form>
                                        </th>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
            </div>

        </div>

    </x-admin-layout>
@stop
