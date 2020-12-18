@extends('layouts.template')

@section('title', 'Home')

@section('header')
    @parent
@endsection

@section('content')

    <h1 class="text-center">Laravel 8 + Bootstrap = Blog .v7 by Andrzej Laczak</h1>

    <img src="{{ asset('/img/laravel.png') }}" class="img-fluid">

    <h3 class="text-center">1-31 August blog project</h3>

@endsection
