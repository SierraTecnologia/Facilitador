
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        @foreach ($models as $model)
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                <span class="info-box-text"><a href="{{$model->getUrl()}}">{{$model->getName()}}</a></span>
                <span class="info-box-number">{{$model->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        @endforeach
    </div>
    <!-- /.col -->
</div>
