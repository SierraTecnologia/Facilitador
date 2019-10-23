@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @include('users.numbers', [
        'collaborators' => $collaborators,
        'sshKeys' => $sshKeys,
        'projects' => $projects,
        'issues' => $issues
    ])

    Colaboradores

    Serviços

    Suporte

    <example-component></example-component>
@stop