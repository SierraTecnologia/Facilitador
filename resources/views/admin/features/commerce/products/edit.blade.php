@extends('layouts.app')

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ Siravel::moduleAsset('commerce', 'css/store.css', 'text/css') }}">
@stop

@section('pageTitle') Products @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('admin.features.commerce.products.breadcrumbs', ['location' => ['edit']])

        @include('admin.features.commerce.products.tabs', $tabs)
    </div>

@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Siravel::moduleAsset('commerce', 'js/products.js', 'application/javascript')) !!}

@endsection
