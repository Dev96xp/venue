@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <h1>Payroll</h1>
@stop

@section('content')

<x-admin-layout>
    @livewire('admin.attendance.payroll-index')
</x-admin-layout>

@stop

@section('css')
@stop

@section('js')
@stop
