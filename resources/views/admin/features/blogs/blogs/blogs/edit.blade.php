@extends('layouts.app')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en') && $blog->translationData(request('lang')))
            @if (isset($blog->translationData(request('lang'))->is_published))
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('blog/'.$blog->translationData(request('lang'))->url) !!}">{!! trans('features.live') !!}</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('admin/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}">{!! trans('features.preview') !!}</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cms::rollbackUrl($blog->translation(request('lang'))) !!}">{!! trans('features.rollback') !!}</a>
        @else
            @if ($blog->is_published)
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('blog/'.$blog->url) !!}">{!! trans('features.live') !!}</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('admin/preview/blog/'.$blog->id) !!}">{!! trans('features.preview') !!}</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cms::rollbackUrl($blog) !!}">{!! trans('features.rollback') !!}</a>
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('admin/blog/'.$blog->id.'/history') !!}">{!! trans('features.history') !!}</a>
        @endif

        <h1 class="page-header">{!! trans('features.blog') !!}</h1>
    </div>

    @include('admin.features.blogs.blogs.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('cms.languages', Cms::config('cms.languages')) as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == Cms::config('cms.default-language'))) class="active" @endif><a href="{{ url('admin/blog/'.$blog->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        <div class="@if (config('cms.live-preview', false)) col-md-6 @endif">
            {!! Form::model($blog, ['route' => ['cms.blog.update', $blog->id], 'method' => 'patch', 'class' => 'edit']) !!}

                <input type="hidden" name="lang" value="{{ request('lang') }}">

                <div class="form-group">
                    <label for="Template">{!! trans('features.template') !!}</label>
                    <select class="form-control" id="Template" name="template">
                        @foreach (BlogService::getTemplatesAsOptions() as $template)
                            @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en') && $blog->translationData(request('lang')))
                                <option @if($template === $blog->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @else
                                <option @if($template === $blog->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en'))
                    {!! FormMaker::fromObject($blog->translationData(request('lang')), Config::get('cms.forms.blog')) !!}
                @else
                    {!! FormMaker::fromObject($blog, Config::get('cms.forms.blog')) !!}
                @endif

                <div class="form-group text-right">
                    <a href="{!! url('admin/blog') !!}" class="btn btn-default raw-left">{!! trans('features.cancel') !!}</a>
                    {!! Form::submit(trans('features.save'), ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
        @if (config('cms.live-preview', false))
            <div class="col-md-6 hidden-sm hidden-xs">
                <div id="wrap">
                    @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en'))
                        <iframe id="frame" src="{!! url('admin/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}"></iframe>
                    @else
                        <iframe id="frame" src="{{ url('admin/preview/blog/'.$blog->id) }}"></iframe>
                    @endif
                </div>
                <div id="frameButtons" class="raw-margin-top-16">
                    <button class="btn btn-default preview-toggle" data-platform="desktop">{!! trans('features.desktop') !!}</button>
                    <button class="btn btn-default preview-toggle" data-platform="mobile">{!! trans('features.mobile') !!}</button>
                </div>
            </div>
        @endif
    </div>

@endsection
