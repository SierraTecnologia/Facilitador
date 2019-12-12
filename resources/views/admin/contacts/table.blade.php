<table class="table table-responsive" id="contacts-table">
    <thead>
        <th>{!! trans('words.title') !!}</th>
        <th>{!! trans('words.contact') !!}</th>
        <th>{!! trans('words.email') !!}</th>
        <th>{!! trans('words.service') !!}</th>
        <th>{!! trans('words.client') !!}</th>
        <th>{!! trans('words.description') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr>
            <td>{!! $contact->title !!}</td>
            <td>{!! $contact->contactcol !!}</td>
            <td>{!! $contact->email_id !!}</td>
            <td>{!! $contact->service_id !!}</td>
            <td>{!! $contact->clients_id !!}</td>
            <td>{!! $contact->description !!}</td>
            <td>
                {!! Form::open(['route' => ['contacts.destroy', $contact->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.contacts.show', [$contact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.contacts.edit', [$contact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('phrases.areYouSure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>