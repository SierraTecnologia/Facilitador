@extends('layouts.app')

@section('pageTitle') Pages @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('admin.features.writelabel.pages.breadcrumbs', ['location' => ['create']])
    </div>
    <div class="col-md-12 mt-4">
        {!! Form::open(['route' => 'admin.pages.store', 'class' => 'add', 'files' => true]) !!}

            {!! FormMaker::setColumns(2)->fromTable('pages', \Illuminate\Support\Facades\Config::get('siravel.forms.page.identity')) !!}
            {!! FormMaker::setColumns(2)->fromTable('pages', \Illuminate\Support\Facades\Config::get('siravel.forms.page.content')) !!}
            {!! FormMaker::setColumns(2)->fromTable('pages', \Illuminate\Support\Facades\Config::get('siravel.forms.page.seo')) !!}
            {!! FormMaker::setColumns(2)->fromTable('pages', \Illuminate\Support\Facades\Config::get('siravel.forms.page.publish')) !!}

            <div class="form-group text-right">
                <a href="{!! url('admin/'.'pages') !!}" class="btn btn-secondary raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
