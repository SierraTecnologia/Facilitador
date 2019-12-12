@extends('layouts.app')

@section('content')
    @include('partials.errors')

    @if (session('message'))
        <div class="">
            {{ session('message') }}
        </div>
    @endif

    <h1>Member: Invite</h1>

    <form method="POST" action="/admin/members/invite">
        {!! csrf_field() !!}

        <div class="">
            @input_maker_label('Email')
            @input_maker_create('email', ['type' => 'string'])
        </div>

        <div class="">
            @input_maker_label('Name')
            @input_maker_create('name', ['type' => 'string'])
        </div>

        <div class="">
            @input_maker_label('Role')
            @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'])
        </div>

        <div class="">
            <a href="{{ URL::previous() }}">Cancel</a>
            <button type="submit">Save</button>
        </div>
    </form>

    <a href="/admin/members">Member Admin</a>
@endsection