{{-- Se estiende l aplantilla LTEAdmin para administrador --}}
@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Calendar</h1>

@stop

@section('content')

    <x-admin-layout>

        <livewire:appointments-calendar week-starts-at="0"
            {{-- :day-click-enabled="false" --}}
            {{-- :event-click-enabled="false" --}}
            {{-- :drag-and-drop-enabled="false" --}}

            before-calendar-view="admin/events/before"
            after-calendar-view="admin/events/after" />

    </x-admin-layout>

@stop

@section('css')

@stop

@section('js')

@stop
