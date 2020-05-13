@extends('layouts.app')

@section('pageTitle') Links @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('admin.features.writelabel.links.breadcrumbs', ['location' => [['Menu' => url('admin/'.'menus/'.$links->menu_id.'/edit')], 'links', 'edit']])
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('layouts.tabs', [ 'module' => 'links', 'item' => $links ])
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        {!! Form::model($links, ['route' => ['admin.links.update', $links->id], 'method' => 'patch', 'class' => 'edit']) !!}

            <input type="hidden" name="lang" value="{{ request('lang') }}">

            {!! FormMaker::fromObject($links->asObject(), \Illuminate\Support\Facades\Config::get('cms.forms.link')) !!}

            <div class="form-group" style="display: none;">
                <label for="Page_id">Page</label>
                <select class="form-control" id="Page_id" name="page_id">
                    @foreach (PageService::getPagesAsOptions() as $key => $value)
                        <option @if($value === $links->page_id) selected  @endif value="{!! $value !!}">{!! $key !!}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group text-right">
                <a href="{!! url()->previous() !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
