@extends('layouts.app')

@section('pageTitle') Blog History @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('admin.features.blogs.blogs.breadcrumbs', ['location' => [[$blog->title => url('admin/'.'blog/'.$blog->id.'/edit')], 'history']])

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-striped">
                    @foreach($blog->history() as $history)
                        <tr>
                            <td>{{ $history->created_at->format('M jS, Y') }} ({{ $history->created_at->diffForHumans() }})</td>
                            <td class="text-right">
                                <a class="btn btn-outline-warning btn-sm" href="{{ url('admin/'.'revert/'.$history->id) }}">Revert</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
