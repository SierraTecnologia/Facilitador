<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
            @foreach ($models as $model)
                @if (is_array($model))
                    <a class="btn btn-app" href="{{$model['url']}}">
                        <span class="badge bg-yellow">{{$model['count']}}</span>
                        {!!$model['icon']!!} {{$model['name']}}
                    </a>
                @else
                    <a class="btn btn-app" href="{{$model->getUrl()}}">
                        <span class="badge bg-yellow">{{$model->getRepository()->count()}}</span>
                        {!!\Support\Template\Layout\Icons::getRandon()!!} {{$model->getName()}}
                    </a>
                @endif
            @endforeach
        </div>
        <!-- /.info-box -->
    </div>
</div>