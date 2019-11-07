<table class="table table-responsive" id="coberturas-table">
    <thead>
        <th>{!! trans('words.name') !!}</th>
        <th>{!! trans('words.type') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
        @if (!empty($registros))
            @foreach($registros as $cobertura)
                <tr>
                    <td>{!! $cobertura->name !!}</td>
                    <td>
                        {!! Form::open(['route' => ['facilitador.destroy', $service->getModelService()->getCryptName(), Crypto::encrypt($cobertura->{$service->getModelService()->getPrimaryKey()})], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('facilitador.show', [ $service->getModelService()->getCryptName(), Crypto::encrypt($cobertura->{$service->getModelService()->getPrimaryKey()})]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{!! route('facilitador.edit', [ $service->getModelService()->getCryptName(), Crypto::encrypt($cobertura->{$service->getModelService()->getPrimaryKey()})]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('phrases.areYouSure')."')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>