<div class="row">
        @foreach ($service->getDiscoverService()->getColumns() as $eloquentColumn)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-text-width"></i>
    
                        <h3 class="box-title">{!! $eloquentColumn->getName() !!}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <blockquote>
                            {!! $eloquentColumn->displayFromModel($register) !!}
                        </blockquote>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endforeach
    </div>