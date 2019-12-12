@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.clients') !!}
        </h1>
   </section>
   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($clients, ['route' => ['clients.update', $clients->id], 'method' => 'patch']) !!}

                        @include('dashboard.clients.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection