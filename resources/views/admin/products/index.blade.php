{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Products</h1>
@stop

@section('content')

<x-admin-layout>
    @livewire('admin.product.products-index',['brand' => $brand, 'category' => $category])
</x-admin-layout>

@stop

@section('css')

@stop

@section('js')

@stop
