@extends('layouts.app')

@section('pageTitle') Menus @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('admin.features.writelabel.menus.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => 'admin.menus.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('menus', \Illuminate\Support\Facades\Config::get('siravel.forms.menu')) !!}

            <div class="form-group text-right">
                <a href="{!! url('admin/'.'menus') !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

