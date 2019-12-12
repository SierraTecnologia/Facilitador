@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            New Configuration
        </h1>
    </section>
    <div class="content">

        <div class="box box-primary">

            <div class="box-body">
                <div class="row">

                    <form method="post" action="{{ route('admin.settings.store', ['slugSetting' => $slugSetting]) }}">
                        {!! csrf_field() !!}
                        @include('admin.settings.fields')
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
