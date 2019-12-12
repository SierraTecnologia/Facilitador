@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.contacts') !!}
        </h1>
   </section>
   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($contact, ['route' => ['contacts.update', $contact->id], 'method' => 'patch']) !!}

                        @include('dashboard.contacts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection