@extends('layouts.dashboard')

@section('pageTitle') Event History @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('admin.features.calendar.events.breadcrumbs', ['location' => [[
            $event->title => url('admin/'.'events/'.$event->id.'/edit')], 'history'
        ]])
    </div>

    <div class="col-md-12">
        <table class="table table-striped">
            @foreach($event->history() as $history)
                <tr>
                    <td>{{ $history->created_at->format('M jS, Y') }} ({{ $history->created_at->diffForHumans() }})</td>
                    <td class="text-right">
                        <a class="btn btn-warning btn-sm" href="{{ url('admin/'.'revert/'.$history->id) }}">Revert</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
