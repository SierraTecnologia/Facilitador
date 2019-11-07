@extends('layouts.dashboard')

@section('pageTitle') Widgets @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('features.widgets.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => 'admin.widgets.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('widgets', $service->getFieldForForm()) !!}

            <div class="form-group text-right">
                <a href="{!! cms()->url('widgets') !!}" class="btn btn-secondary raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
