<table class="table table-responsive" id="accounts-table">
    <thead>
        <th>{!! trans('words.service') !!}</th>
        <th>{!! trans('words.username') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
        @if (!empty($accounts))
            @foreach($accounts as $account)
                <tr>
                    <td>{!! $account->integration->name !!}</td>
                    <td>{!! $account->username !!}</td>
                    <td>
                        {!! Form::open(['route' => ['admin.accounts.destroy', $account->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('admin.accounts.show', [$account->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{!! route('admin.accounts.edit', [$account->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('phrases.areYouSure')."')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>