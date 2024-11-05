@extends('adminlte::page')

@section('codersfree', 'Dashboard')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.brands.create') }}">Nueva Marca</a>
    <h1>Business</h1>

@stop

@section('content')

    <x-admin-layout>



        {{-- Informacion del negocio para este website --}}
        <div class="col-span-1 mb-6">
            <div class="card">
                <div class="card-body">

                    <div class="grid grid-cols-1 lg:grid-cols-4">
                        <div class="col-span-1">
                            <form action="{{ route('admin.business.update', $business) }}" method="POST">
                                @csrf
                                @method('POST')

                                {{-- Category name --}}
                                <div class="form-group">
                                    <label for="">
                                        Business name
                                    </label>

                                    <input type="text" class="form-control font-bold" name="name" id="name"
                                        value="{{ $business->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Category name --}}
                                <div class="form-group">
                                    <label for="">
                                        Address
                                    </label>

                                    <input type="text" class="form-control font-bold" name="address" id="address"
                                        value="{{ $business->address }}">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class=" grid grid-cols-2 gap-2">
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="">City</label>

                                            <input type="text" class="form-control font-bold" name="city"
                                                id="city" value="{{ $business->city }}">
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-span-1">

                                        <div class="form-group">
                                            <label for="">State</label>

                                            <input type="text" class="form-control font-bold" name="state"
                                                id="state" value="{{ $business->state }}">
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class=" grid grid-cols-2 gap-2">
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="">zip</label>

                                            <input type="text" class="form-control font-bold" name="zip"
                                                id="zip" value="{{ $business->zip }}">
                                            @error('zip')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-span-1">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">email</label>

                                    <input type="text" class="form-control font-bold" name="email"
                                        id="email" value="{{ $business->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class=" grid grid-cols-2 gap-2">
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="">mobile 1</label>

                                            <input type="text" class="form-control font-bold" name="phone"
                                                id="phone" value="{{ $business->phone }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="">mobile 2</label>

                                            <input type="text" class="form-control font-bold" name="phone2"
                                                id="phone2" value="{{ $business->phone2 }}">
                                            @error('phone2')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                {{-- Code --}}
                                <div class="form-group">
                                    <label for="">
                                        Slogan
                                    </label>

                                    <input type="text" class="form-control font-bold" name="slogan" id="code"
                                        value="{{ $business->slogan }}">
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Time --}}
                                <div class="form-group">
                                    <label for="">
                                        Description
                                    </label>

                                    <input type="textarea" class="form-control font-bold" name="description" id="time"
                                        value="{{ $business->description }}">
                                    @error('time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="">
                                        link 1 Facebook
                                    </label>

                                    <input type="text" class="form-control font-bold" name="link" id="link"
                                        value="{{ $business->link }}">
                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">
                                        link 2 Instagram
                                    </label>

                                    <input type="text" class="form-control font-bold" name="link2" id="link2"
                                        value="{{ $business->link2 }}">
                                    @error('link2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">
                                        link 3 Youtube
                                    </label>

                                    <input type="text" class="form-control font-bold" name="link3" id="link3"
                                        value="{{ $business->link3 }}">
                                    @error('link3')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button class="btn btn-danger mt-2 bg-red-300" type="submit">
                                    Update
                                </button>
                            </form>
                        </div>

                        <div class="col-span-1">
                            {{-- NADA --}}
                        </div>
                        <div class="col-span-1">
                            {{-- NADA --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </x-admin-layout>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
