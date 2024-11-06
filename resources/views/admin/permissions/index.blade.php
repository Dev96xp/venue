@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>PERMISSIONS SETTINGS x</h1>
@stop

@section('content')


    {{-- Componente de Livewire --}}
    <x-admin-layout>

        <div class="grid grid-cols-6 gap-6">

            <div class="col-span-2">
                @livewire('admin.permission.permission-index')
            </div>

            <div class="col-span-2">
                {{-- @livewire('admin.id.id-index') --}}
            </div>

            <div class="col-span-2">
                {{-- @livewire('admin.stores.stores-index') --}}
            </div>

            <div class="col-span-2">
                @livewire('admin.payment.payments-index')
            </div>
        </div>

    </x-admin-layout>


@stop

@section('css')

@stop

@section('js')

@stop
