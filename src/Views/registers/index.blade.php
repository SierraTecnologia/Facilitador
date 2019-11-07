@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.cobertura') !!}
        </h1>
    </section>

    {{-- <section class="content-header">
        <h1>
          ChartJS
          <small>Preview sample</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Charts</a></li>
          <li class="active">ChartJS</li>
        </ol>
      </section> --}}
    <div class="content">

        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('facilitador::registers.show_fields')
                    <a href="{!! route('facilitador.index', [ $service->getModelService()->getCryptName()]) !!}" class="btn btn-default">{!! trans('words.back') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
