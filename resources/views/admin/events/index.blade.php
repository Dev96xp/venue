{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    {{-- <h1>Events</h1> --}}
@stop

@section('content')

    <x-admin-layout>
        @livewire('admin.event.events-index')
    </x-admin-layout>

@stop

@section('css')

@stop

@section('js')

@stop
