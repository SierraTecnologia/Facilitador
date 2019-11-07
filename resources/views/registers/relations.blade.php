@foreach ($modelRelationsResults as $relationResult)


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">
                    {!! $service->getModelService()->getName() !!} {!! $relationResult->repository->getModelService()->getName(true) !!}
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    @include('facilitador::repositories.table', ['registros' => $relationResult->results,'service' => $relationResult->repository] )
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </div>


@endforeach


