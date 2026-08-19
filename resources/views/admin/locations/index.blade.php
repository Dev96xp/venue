@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Buildings</h1>
@stop

@section('content')

<x-admin-layout>
    @livewire('admin.location.locations-index')
</x-admin-layout>

@stop

@section('css')
@stop

@section('js')
@stop
