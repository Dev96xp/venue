@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    Upload proofing images
@stop

@section('content')

    <x-admin-layout>
        <div class="grid grid-cols-1 lg:grid-cols-4">
            <div class="col-span-2 mb-6">
                @livewire('admin.proof.users-index')
            </div>
            <div class="col-span-2">
                @livewire('admin.proof.gallery-index')      {{-- Aqui es donde se suben la fotos --}}
                @livewire('admin.proof.selected-photos')      {{-- Aqui es donde se muestran las fotos selecionadas
                                                                    por el cliente --}}
            </div>

        </div>

    </x-admin-layout>

@stop

@section('css')

@stop

@section('js')

@stop

