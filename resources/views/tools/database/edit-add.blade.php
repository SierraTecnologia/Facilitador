@extends('pedreiro::layouts.voyager.master')
@if($db->action == 'update')
    @section('page_title', __('pedreiro::database.editing_table', ['table' => $db->table->name]))
@else
    @section('page_title', __('pedreiro::database.create_new_table'))
@endif

@section('page_header')
    <h1 class="page-title">
        <i class="facilitador-data"></i>
        @if($db->action == 'update')
            {{ __('pedreiro::database.editing_table', ['table' => $db->table->name]) }}
        @else
            {{ __('pedreiro::database.create_new_table') }}
        @endif
    </h1>
@stop

@section('breadcrumbs')
<ol class="breadcrumb hidden-xs">
    <li>
        <a href="{{ route('rica.dashboard')}}"><i class="facilitador-boat"></i> {{ __('pedreiro::generic.dashboard') }}</a>
    </li>
    <li>
        <a href="{{ route('facilitador.database.index') }}">
            {{ __('pedreiro::generic.database') }}
        </a>
    </li>

    @if($db->action == 'update')
    <li class="active">{{ __('pedreiro::generic.edit') }}</li>
    <li class="active">{{ $db->table->name }}</li>
    @else
    <li class="active">{{ __('pedreiro::generic.add') }}</li>
    @endif
</ol>
@endsection

@section('content')

    <div class="page-content container-fluid">
        <div class="row">
            <div id="dbManager" class="col-md-12">
                <form ref="form" @submit.prevent="stringifyTable" @keydown.enter.prevent action="{{ $db->formAction }}" method="POST">
                    @if($db->action == 'update'){{ method_field('PUT') }}@endif

                    <database-table-editor :table="table"></database-table-editor>

                    <input type="hidden" :value="tableJson" name="table">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>

@stop

@section('javascript')
    @include('facilitador::tools.database.vue-components.database-table-editor')

    <script>
        new Vue({
            el: '#dbManager',
            data: {
                table: {},
                originalTable: {!! $db->table->toJson() !!}, // to do comparison later?
                oldTable: {!! $db->oldTable !!},
                tableJson: ''
            },
            created() {
                // If old table is set, use it to repopulate the form
                if (this.oldTable) {
                    this.table = this.oldTable;
                } else {
                    this.table = JSON.parse(JSON.stringify(this.originalTable));
                }
            },
            methods: {
                stringifyTable() {
                    this.tableJson = JSON.stringify(this.table);

                    this.$nextTick(() => this.$refs.form.submit());
                }
            }
        });
    </script>

@stop
