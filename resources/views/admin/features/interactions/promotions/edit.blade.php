@extends('layouts.app')

@section('pageTitle') Promotions @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                @include('admin.features.promotions.breadcrumbs', ['location' => ['edit']])
            </div>
            <div class="col-md-6">
                <div class="btn-toolbar float-right mt-2 mb-4">
                    @if (! cms()->isDefaultLanguage() && $promotion->translationData(request('lang')))
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($promotion->translation(request('lang'))) !!}">Rollback</a>
                    @elseif (is_null(request('lang')))
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($promotion) !!}">Rollback</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('layouts.tabs', [ 'module' => 'promotions', 'item' => $promotion ])
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="@if (config('cms.live-preview', false)) col-md-6 @else col-md-12 @endif">
                {!! Form::model($promotion, ['route' => ['admin.promotions.update', $promotion->id], 'method' => 'patch', 'class' => 'edit']) !!}

                    <input type="hidden" name="lang" value="{{ request('lang') }}">

                    {!! FormMaker::setColumns(3)->fromObject($promotion->asObject(), config('cms.forms.promotion.identity')) !!}
                    {!! FormMaker::setColumns(1)->fromObject($promotion->asObject(), config('cms.forms.promotion.content')) !!}

                    <div class="form-group text-right">
                        <a href="{!! url('admin/'.'promotions') !!}" class="btn btn-secondary float-left">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
            @if (config('cms.live-preview', false))
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div id="wrap">
                        @if (! cms()->isDefaultLanguage())
                            <iframe id="frame" src="{!! url('admin/'.'preview/promotion/'.$promotion->id.'?lang='.request('lang')) !!}"></iframe>
                        @else
                            <iframe id="frame" src="{{ url('admin/'.'preview/promotion/'.$promotion->id) }}"></iframe>
                        @endif
                    </div>
                    <div id="frameButtons" class="raw-margin-top-16">
                        <button class="btn btn-secondary preview-toggle" data-platform="desktop">Desktop</button>
                        <button class="btn btn-secondary preview-toggle" data-platform="mobile">Mobile</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
