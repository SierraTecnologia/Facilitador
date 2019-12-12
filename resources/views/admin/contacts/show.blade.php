@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.contact') !!}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('dashboard.contacts.show_fields')
                    <a href="{!! route('admin.contacts.index') !!}" class="btn btn-default">{!! trans('words.back') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
