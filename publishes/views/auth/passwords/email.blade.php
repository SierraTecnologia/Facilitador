@extends('layouts.frontend')

@section('content')

    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <h1 class="text-center">{!! trans('features.forgotPassword') !!}</h1>

            <form method="POST" action="/password/email">
                {!! csrf_field() !!}
                @include('partials.errors')
                @include('partials.status')
                <div class="col-md-12 pull-left">
                    <label>{!! trans('features.email') !!}</label>
                    <input class="form-control" type="email" name="email" placeholder="{!! trans('features.emailAddress') !!}" value="{{ old('email') }}">
                </div>
                <div class="col-md-12 pull-left form-group">
                    <a class="btn btn-default pull-left" href="/login">{!! trans('features.waitIRemember') !!}</a>
                    <button class="btn btn-primary pull-right" type="submit" class="button">{!! trans('features.sendPasswordResetLink') !!}</button>
                </div>
            </form>

        </div>
    </div>

@stop
