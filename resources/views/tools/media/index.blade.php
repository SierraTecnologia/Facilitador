@extends('facilitador::layouts.voyager.master')

@section('page_title', __('facilitador::generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('facilitador::alerts')
        <div class="row">
            <div class="col-md-12">

                <div class="admin-section-title">
                    <h3><i class="facilitador-images"></i> {{ __('facilitador::generic.media') }}</h3>
                </div>
                <div class="clear"></div>
                <div id="filemanager">
                    <media-manager
                        base-path="{{ config('sitec.facilitador.media.path', '/') }}"
                        :show-folders="{{ config('sitec.facilitador.media.show_folders', true) ? 'true' : 'false' }}"
                        :allow-upload="{{ config('sitec.facilitador.media.allow_upload', true) ? 'true' : 'false' }}"
                        :allow-move="{{ config('sitec.facilitador.media.allow_move', true) ? 'true' : 'false' }}"
                        :allow-delete="{{ config('sitec.facilitador.media.allow_delete', true) ? 'true' : 'false' }}"
                        :allow-create-folder="{{ config('sitec.facilitador.media.allow_create_folder', true) ? 'true' : 'false' }}"
                        :allow-rename="{{ config('sitec.facilitador.media.allow_rename', true) ? 'true' : 'false' }}"
                        :allow-crop="{{ config('sitec.facilitador.media.allow_crop', true) ? 'true' : 'false' }}"
                        :details="{{ json_encode(['thumbnails' => config('sitec.facilitador.media.thumbnails', []), 'watermark' => config('sitec.facilitador.media.watermark', (object)[])]) }}"
                        ></media-manager>
                </div>
            </div><!-- .row -->
        </div><!-- .col-md-12 -->
    </div><!-- .page-content container-fluid -->
@stop

@section('javascript')
<script>
new Vue({
    el: '#filemanager'
});
</script>
@endsection
