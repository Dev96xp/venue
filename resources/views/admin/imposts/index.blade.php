{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Impost</h1>
@stop

@section('content')

<x-admin-layout>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

        <div class="col-span-1 mb-6">
            @livewire('admin.impost.impost-index')
        </div>

        <div class="col-span-1 mb-6">
            @livewire('admin.impost.tax-index')
        </div>
        <div class="col-span-1 mb-6">

        </div>
        <div class="col-span-1 mb-6">

        </div>

    </div>
</x-admin-layout>

@stop

@section('css')

@stop

@section('js')

@stop
