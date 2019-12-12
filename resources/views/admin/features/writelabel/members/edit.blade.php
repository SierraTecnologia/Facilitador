@extends('layouts.app')

@section('content')

    @include('partials.errors')

    @if (session('message'))
        <div class="">
            {{ session('message') }}
        </div>
    @endif

    <form method="POST" action="/admin/members/{{ $member->id }}">
        <input name="_method" type="hidden" value="PATCH">
        {!! csrf_field() !!}

        <div>
            @input_maker_label('Email')
            @input_maker_create('email', ['type' => 'string'], $member)
        </div>

        <div>
            @input_maker_label('Name')
            @input_maker_create('name', ['type' => 'string'], $member)
        </div>

        @include('member.meta')

        <div>
            @input_maker_label('Role')
            @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'], $member)
        </div>

        <div>
            <a href="{{ URL::previous() }}">Cancel</a>
            <button type="submit">Save</button>
        </div>
    </form>

    @if (! Session::get('original_member'))
        <a href="/admin/members/switch/{{ $member->id }}">Login as this Member</a>
    @endif

    <a href="/admin/members">Member Admin</a>
@endsection