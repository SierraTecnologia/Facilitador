@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @include('facilitador::dash.numbers', [
        'models' => $models,
    ])

    <example-component></example-component>
@stop