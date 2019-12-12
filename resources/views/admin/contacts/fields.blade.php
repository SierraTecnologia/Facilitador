<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', trans('words.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Contactcol Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contactcol', trans('words.contact').':') !!}
    {!! Form::text('contactcol', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_id', trans('words.email').':') !!}
    {!! Form::select(
        'email_id', $emails, null,
        ['class' => 'form-control', 'placeholder' => trans('dashboard/contact.selectEmail')]
    ) !!}
</div>

<!-- Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_id', trans('words.service').':') !!}
    {!! Form::select(
        'service_id', $services, null,
        ['class' => 'form-control', 'placeholder' => trans('dashboard/contact.selectService')]
    ) !!}
</div>

<!-- Clients Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clients_id', trans('words.client').':') !!}
    {!! Form::select(
        'clients_id', $clients, null,
        ['class' => 'form-control', 'placeholder' => trans('dashboard/contact.selectClient')]
    ) !!}

</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', trans('words.description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('words.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.contacts.index') !!}" class="btn btn-default">{!! trans('words.cancel') !!}</a>
</div>
