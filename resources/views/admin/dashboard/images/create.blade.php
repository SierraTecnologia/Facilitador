@extends('layouts.app')

@section('pageTitle') Images @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('admin.features.midia.images.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12 mt-2">
        {!! Form::open(['url' => url('admin/'.'images/upload'), 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}

        {!! Form::open(['route' => 'admin.images.store', 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('files', \Illuminate\Support\Facades\Config::get('cms.forms.images')) !!}

            <div class="form-group text-right">
                <a href="{!! url('admin/'.'images') !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveImagesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
