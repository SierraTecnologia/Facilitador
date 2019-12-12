@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Event History</h1>
    </div>

    @include('admin.features.calendar.events.breadcrumbs', ['location' => [[$event->title => url('admin/events/'.$event->id.'/edit')], 'history']])

    <div class="row">
        <table class="table table-striped">
        @foreach($event->history() as $history)
            <tr>
                <td>{{ $history->created_at->format('M jS, Y') }} ({{ $history->created_at->diffForHumans() }})</td>
                <td class="text-right"><a class="btn btn-warning btn-link btn-xs" href="{{ url('admin/revert/'.$history->id) }}">Revert</a></td>
            </tr>
        @endforeach
        </table>
    </div>

@endsection
