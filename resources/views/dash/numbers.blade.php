@php
$i = 1
@endphp
@foreach ($models as $model)
    @if ($i==1)
        <div class="row">
    @endif
    <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">
            <a class="btn btn-app" href="{{$model->getUrl()}}">
                <span class="badge bg-yellow">{{$model->getRepository()->count()}}</span>
                {!!\Facilitador\Layout\Icons::getRandon()!!} {{$model->getName()}}
            </a>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    @if ($i==4)
        </div>
        @php
        $i = 0
        @endphp
    @endif
    @php
    $i = $i+1
    @endphp
@endforeach
