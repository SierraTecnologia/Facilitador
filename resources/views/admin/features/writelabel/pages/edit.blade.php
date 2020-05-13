@extends('layouts.app')

@section('pageTitle') Pages @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                @include('admin.features.writelabel.pages.breadcrumbs', ['location' => ['edit']])
            </div>
            <div class="col-md-6">
                <div class="btn-toolbar float-right mt-2">
                    @if (! cms()->isDefaultLanguage() && $page->translationData(request('lang')))
                        @if (isset($page->translationData(request('lang'))->is_published))
                            <a class="btn btn-primary ml-1" href="{!! url('page/'.$page->translationData(request('lang'))->url) !!}">Live</a>
                        @else
                            <a class="btn btn-outline-success ml-1" href="{!! url('admin/'.'preview/page/'.$page->id.'?lang='.request('lang')) !!}">Preview</a>
                        @endif
                         <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($page->translation(request('lang'))) !!}">Rollback</a>
                    @else
                        @if ($page->is_published)
                            <a class="btn btn-primary ml-1" href="{!! url('page/'.$page->url) !!}">Live</a>
                        @else
                            <a class="btn btn-outline-success ml-1" href="{!! url('admin/'.'preview/page/'.$page->id) !!}">Preview</a>
                        @endif
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($page) !!}">Rollback</a>
                        <a class="btn btn-outline-secondary ml-1" href="{!! url('admin/'.'pages/'.$page->id.'/history') !!}">History</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('layouts.tabs', [ 'module' => 'pages', 'item' => $page ])
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="@if (\Illuminate\Support\Facades\Config::get('cms.live-preview', false)) col-md-6 @else col-md-12 @endif">
                {!! Form::model($page, ['route' => ['admin.pages.update', $page->id], 'method' => 'patch', 'class' => 'edit', 'files' => true]) !!}

                    <input type="hidden" name="lang" value="{{ request('lang') }}">

                    {!! FormMaker::setColumns(2)->fromObject($page->asObject(), \Illuminate\Support\Facades\Config::get('cms.forms.page.identity')) !!}

                    <div class="form-group">
                        <label for="Template">Template</label>
                        <select class="form-control" id="Template" name="template">
                            @foreach (PageService::getTemplatesAsOptions() as $template)
                                @if (! cms()->isDefaultLanguage() && $page->translationData(request('lang')))
                                    <option @if($template === $page->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                                @else
                                    <option @if($template === $page->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! FormMaker::setColumns(1)->fromObject($page->asObject(), \Illuminate\Support\Facades\Config::get('cms.forms.page.content')) !!}
                        </div>
                        <div class="col-md-6">
                            @if ($page->hero_image)
                                <img class="img-thumbnail img-fluid" src="{{ $page->hero_image_url }}" alt="">
                                <div class="btn-toolbar mt-2 mb-4" role="toolbar">
                                    <a href="{{ url('admin/'.'hero-images/delete/page/'.$page->id) }}" class="btn btn-outline-danger">
                                        <span class="fa fa-fw fa-trash"></span> Delete Image
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-4">
                            {!! FormMaker::setColumns(2)->fromObject($page->asObject(), \Illuminate\Support\Facades\Config::get('cms.forms.page.seo')) !!}
                        </div>
                    </div>

                    {!! FormMaker::setColumns(2)->fromObject($page->asObject(), \Illuminate\Support\Facades\Config::get('cms.forms.page.publish')) !!}

                    @include('admin.features.blocks', ['item' => $page->asObject()])

                    <div class="form-group text-right">
                        <a href="{!! url('admin/'.'pages') !!}" class="btn btn-secondary raw-left">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
            @if (\Illuminate\Support\Facades\Config::get('cms.live-preview', false))
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div id="wrap">
                        @if (! cms()->isDefaultLanguage())
                            <iframe id="frame" src="{!! url('admin/'.'preview/page/'.$page->id.'?lang='.request('lang')) !!}"></iframe>
                        @else
                            <iframe id="frame" src="{{ url('admin/'.'preview/page/'.$page->id) }}"></iframe>
                        @endif
                    </div>
                    <div id="frameButtons" class="mt-2">
                        <button class="btn btn-secondary preview-toggle" data-platform="desktop">Desktop</button>
                        <button class="btn btn-secondary preview-toggle" data-platform="mobile">Mobile</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
