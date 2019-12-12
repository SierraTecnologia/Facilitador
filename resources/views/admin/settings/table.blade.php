<table class="table table-responsive" id="settings-table">
    <thead>
        <th>{!! trans('words.name') !!}</th>
        <th>{!! trans('words.description') !!}</th>
        <th>{!! trans('words.value') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
        @if (!empty($settings))
            @foreach($settings as $setting)
                <tr>
                    <td>{!! $setting->getAppAtribute('name') !!}</td>
                    <td>{!! $setting->getAppAtribute('description') !!}</td>
                    <td>{!! $setting->value !!}</td>
                    <td>
                        {!! Form::open(['route' => ['admin.settings.destroy', $setting->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('admin.settings.edit', [$setting->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('phrases.areYouSure')."')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>