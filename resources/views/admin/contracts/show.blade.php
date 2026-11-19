@extends('adminlte::page')

@section('title', 'Contracts')

@section('content_header')
    <h1>Contract {{ $contract->code }}</h1>
@stop

@section('content')

<x-admin-layout>
    @livewire('admin.contract.contract-show', ['contract' => $contract])
</x-admin-layout>

@stop

@section('css')
    @include('admin.contracts.partials.styles')
@stop
