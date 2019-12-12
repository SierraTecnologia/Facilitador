@extends('layouts.dashboard')

@section('pageTitle') Page History @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('admin.features.writelabel.pages.breadcrumbs', ['location' => [[$page->title => url('admin/'.'pages/'.$page->id.'/edit')], 'history']])
    </div>

    <div class="col-md-12 mt-4">
        <table class="table table-striped">
            @foreach($page->history() as $history)
                <tr>
                    <td>{{ $history->created_at->format('M jS, Y') }} ({{ $history->created_at->diffForHumans() }})</td>
                    <td class="text-right">
                        <a class="btn btn-outline-warning btn-sm" href="{{ url('admin/'.'revert/'.$history->id) }}">Revert</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
