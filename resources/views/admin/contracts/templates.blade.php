@extends('adminlte::page')

@section('title', 'Contract templates')

@section('content_header')
    <h1>Contract templates</h1>
@stop

@section('content')

<x-admin-layout>
    @livewire('admin.contract.contract-templates')
</x-admin-layout>

@stop

@section('css')
    @include('admin.contracts.partials.styles')
@stop
