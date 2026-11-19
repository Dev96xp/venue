@extends('adminlte::page')

@section('title', 'Contracts')

@section('content_header')
    <h1>{{ $contract ? 'Edit contract ' . $contract->code : 'New contract' }}</h1>
@stop

@section('content')

<x-admin-layout>
    @livewire('admin.contract.contract-form', ['contract' => $contract, 'user' => $user])
</x-admin-layout>

@stop

@section('css')
    @include('admin.contracts.partials.styles')
@stop
