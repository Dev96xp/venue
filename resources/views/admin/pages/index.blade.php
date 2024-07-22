{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    {{-- <h1>Products</h1> --}}
@stop

@section('content')

<x-admin-layout>

    <div class="grid grid-cols-2 lg:grid-cols-8">

        <div class="col-span-5 mb-6">
            @livewire('admin.page.page-index')
        </div>
        <div class="col-span-3 mb-6">
            @livewire('admin.page.page-sections')
        </div>

    </div>


</x-admin-layout>

@stop

@section('css')

@stop

@section('js')

@stop
