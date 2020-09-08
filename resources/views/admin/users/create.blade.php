@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.user') !!}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('words.home') !!}</a></li>
            <li><a href="{!! route('admin.users.index') !!}"><i class="fa fa-key"></i> {!! trans('words.users') !!}</a></li>
            <li class="active">{!! trans('words.addNew') !!}</li>
        </ol>
    </section>
    <div class="content">

        <div class="box card box-primary">

            <div class="box-body card-body">
                <div class="row">
                    {!! Form::open(['route' => 'users.store']) !!}

                        @include('facilitador::admin.users.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection