<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', trans('words.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Clients Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('clients_id', trans('words.client').':') !!}
    {!! Form::select(
        'clients_id', $clients, 'S', ['class' => 'form-control', 'placeholder' => trans('dashboard/contact.selectClient')]
    ) !!}
</div>

<!-- Dominios Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dominios_id', trans('words.dominio').':') !!}
    {!! Form::select(
        'dominios_id', $dominios, 'S', ['class' => 'form-control', 'placeholder' => trans('dashboard/account.selectDominio')]
    ) !!}
</div>

<!-- Account Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('account_category_id', trans('words.category').':') !!}
    {!! Form::select(
        'account_category_id', $accountCategory, 'S', ['class' => 'form-control', 'placeholder' => trans('dashboard/account.selectCategory')]
    ) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('words.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.accounts.index') !!}" class="btn btn-default">{!! trans('words.cancel') !!}</a>
</div>
