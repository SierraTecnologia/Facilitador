<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', trans('words.id').':') !!}
    <p>{!! $account->id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('words.updatedAt').':') !!}
    <p>{!! $account->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('words.createdAt').':') !!}
    <p>{!! $account->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', trans('words.deletedAt').':') !!}
    <p>{!! $account->deleted_at !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('words.name').':') !!}
    <p>{!! $account->name !!}</p>
</div>

<!-- Clients Id Field -->
<div class="form-group">
    {!! Form::label('clients_id', trans('words.client').':') !!}
    <p>{!! $account->clients_id !!}</p>
</div>

<!-- Dominios Id Field -->
<div class="form-group">
    {!! Form::label('dominios_id', trans('words.dominio').':') !!}
    <p>{!! $account->dominios_id !!}</p>
</div>

<!-- Account Category Id Field -->
<div class="form-group">
    {!! Form::label('account_category_id', trans('dashboard.account.accountCategoryId').':') !!}
    <p>{!! $account->account_category_id !!}</p>
</div>

