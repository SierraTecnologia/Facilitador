@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Members
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Cadastrado</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($members as $member)
                                    <tr>
                                        <td>{{ $member->user->name }}</td>
                                        <td>{{ $member->user->email }}</td>
                                        <td>{{ $member->created_at->diffForHumans() }}</td>
                                        <td>{{ $member->posts_count }}</td>
                                        <td>
                                            <a href="{{ url("/admin/members/{$member->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No member available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $members->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
