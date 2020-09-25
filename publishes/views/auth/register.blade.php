@extends('layouts.frontend')

@section('content')

    <div class="row raw-margin-top-72">
        <div class="col-md-4 col-md-offset-4">

            <h1 class="text-center">{!! trans('features.register') !!}</h1>

            <form method="POST" action="/register">
                {!! csrf_field() !!}

                @include('pedreiro::partials.errors')
                @include('partials.status')

                <div class="col-md-12 form-group">
                    <label>{!! trans('features.name') !!}</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group row">
                    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar (optional)') }}</label>

                    <div class="col-md-6">
                        <input id="avatar" type="file" class="form-control" name="avatar">
                    </div>
                </div>
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
                    <a class="btn btn-secondary float-left" href="/login">{!! trans('features.login') !!}</a>
                    <button class="btn btn-primary float-right" type="submit">{!! trans('features.register') !!}</button>
                </div>
            </form>

        </div>
    </div>

@stop