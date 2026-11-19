@extends('adminlte::page')

@section('title', 'Contracts')

@section('content_header')
    <h1>Contracts</h1>
@stop

@section('content')

<x-admin-layout>
    @livewire('admin.contract.contracts-index')
</x-admin-layout>

@stop

@section('css')
    @include('admin.contracts.partials.styles')
@stop
