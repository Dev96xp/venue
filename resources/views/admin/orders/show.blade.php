{{-- Se estiende la plantilla LTEAdmin para administrador --}}
{{-- ESTO SE COPIO DEL WEBSITE DE LTEAdmin - PLANTILLA PRINCIPAL  --}}

@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')

@stop

@section('content')

    {{-- Plantilla Principal --}}
    <x-admin-layout>
        @livewire('admin.order.status-order', ['order' => $order])
    </x-admin-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>console.log('Hi!'); </script>
@stop
