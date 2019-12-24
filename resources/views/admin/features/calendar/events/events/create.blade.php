@extends('layouts.app')

@section('content')

    <div class="row">
        <h1 class="page-header">Events</h1>
    </div>

    @include('admin.features.calendar.events.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => 'admin.events.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('events', Config::get('cms.forms.event')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('admin/events') !!}" class="btn btn-default raw-left">{!! trans('features.cancel') !!}</a>
                {!! Form::submit(trans('features.save'), ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
