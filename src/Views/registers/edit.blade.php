@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.cobertura') !!}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('words.home') !!}</a></li>
            <li><a href="{!! route('facilitador.index') !!}"><i class="fa fa-key"></i> {!! trans('words.coberturas') !!}</a></li>
            <li class="active">{!! trans('words.edit') !!}</li>
        </ol>
   </section>
   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">

                   @include('layouts.partials.message')

                   {!! Form::model($cobertura, ['route' => ['coberturas.update', $cobertura->id], 'method' => 'patch']) !!}

                        @include('facilitador::repositories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection