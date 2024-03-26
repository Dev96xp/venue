{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Configuration Events</h1>
@stop

@section('content')

    <x-admin-layout>

        @livewire('admin.event.package-configuration')

        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-2">
                @livewire('admin.event.location-index')
            </div>
            <div class="col-span-2"></div>
            <div class="col-span-2"></div>
        </div>
    </x-admin-layout>

@stop

@section('css')

@stop

@section('js')

@stop
