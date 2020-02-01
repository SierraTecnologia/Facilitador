<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-text-width"></i>

                    <h3 class="box-title">Description</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl>
                        @foreach ($service->getDiscoverService()->getColumns()) as $eloquentColumn)
                            <dt>{!! $eloquentColumn->getName() !!}</dt>
                            <dd>{!! $eloquentColumn->displayFromModel($register) !!}</dd>
                        @endforeach
                    </dl>
                </div>
            <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>