<table class="table table-responsive" id="coberturas-table">
    <thead>
        <th>{!! trans('words.name') !!}</th>
        <th>{!! trans('words.type') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
        @if (!empty($coberturas))
            @foreach($coberturas as $cobertura)
                <tr>
                    <td>{!! $cobertura->content !!}</td>
                    <td>{!! $cobertura->addressType->name !!}</td>
                    <td>
                        {!! Form::open(['route' => ['team.coberturas.destroy', $cobertura->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('team.coberturas.show', [$cobertura->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{!! route('team.coberturas.edit', [$cobertura->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('phrases.areYouSure')."')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>