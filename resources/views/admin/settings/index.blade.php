@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{!! trans('words.users') !!}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('words.home') !!}</a></li>
            <li class="active">{!! trans('words.users') !!}</li>
        </ol>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('layouts.partials.message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.settings.table')
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.settings.table-others')
            </div>
        </div>
    </div>
@endsection

