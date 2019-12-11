<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
            @foreach ($models as $model)
                <a class="btn btn-app" href="{{$model->getUrl()}}">
                    <span class="badge bg-yellow">{{$model->getRepository()->count()}}</span>
                    {!!\Facilitador\Layout\Icons::getRandon()!!} {{$model->getName()}}
                </a>
            @endforeach
        </div>
        <!-- /.info-box -->
    </div>
</div>