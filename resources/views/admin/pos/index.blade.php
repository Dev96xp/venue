@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')

@stop

@section('content')

    {{-- Plantilla Principal --}}
    <x-admin-layout>
        @livewire('admin.pos.pos-index', ['user' => $user])
    </x-admin-layout>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>console.log('Hi!'); </script>
@stop
