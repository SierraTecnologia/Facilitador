@extends('layout.frontend')

@section('content')

    <div class="row raw-margin-top-72">
        <div class="col-md-4 col-md-offset-4">

            <h1 class="text-center">{!! trans('features.passwordReset') !!}</h1>

            <form method="POST" action="/password/reset">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">

                @include('partials.errors')
                @include('partials.status')

                <div class="col-md-12 form-group">
                    <label>{!! trans('features.email') !!}</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>{!! trans('features.password') !!}</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="col-md-12 form-group">
                    <label>{!! trans('features.confirmPassword') !!}</label>
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
                <div class="col-md-12 form-group">
                    <button class="btn btn-primary" type="submit">{!! trans('features.passwordReset') !!}</button>
                </div>
            </form>
        </div>
    </div>

@stop