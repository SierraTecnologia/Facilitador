<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

    @foreach ($models as $groupName=>$realModels)
        <div class="panel box box-{{ $loop->first ? 'primary' : 'danger' }}">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{!! $groupName !!}">
                    {!! $groupName !!}
                    </a>
                </h4>
            </div>
            <div id="collapse{!! $groupName !!}" class="panel-collapse collapse{{ $loop->first ? ' in' : '' }}">
                <div class="box-body">

                    @include('facilitador::components.dash.numbers', [
                        'models' => $realModels->groupBy('register_type')
                    ])

                </div>
            </div>

        </div>
        <!-- /.tab-pane -->
    @endforeach
</div>