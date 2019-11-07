@extends('layouts.app')



@section('title', 'Show '.$service->getModelService()->getName())

@section('content_header')
    <h1>Show {!! $service->getModelService()->getName() !!}</h1>
@stop

@section('css')

@stop

@section('js')

@stop

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show {!! $service->getModelService()->getName() !!}</h2>

            </div>

            <div class="pull-right">

                <a href="{!! route('facilitador.index', [ $service->getModelService()->getCryptName()]) !!}" class="btn btn-default">{!! trans('words.back') !!}</a>

            </div>

        </div>

    </div>

    @include('facilitador::registers.attributes')

    @include('facilitador::registers.relations')

@endsection
