@extends('layouts.app')

@section('content')

    <div class="row">
        <h1 class="page-header">{!! trans('features.blog') !!}</h1>
    </div>

    @include('admin.features.blogs.blogs.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => 'admin.blog.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('blogs', Config::get('cms.forms.blog')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('admin/blog') !!}" class="btn btn-default raw-left">{!! trans('features.cancel') !!}</a>
                {!! Form::submit(trans('features.save'), ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
