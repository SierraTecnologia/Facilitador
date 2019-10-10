<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', trans('words.id').':') !!}
    <p>{!! $cobertura->id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('words.updatedAt').':') !!}
    <p>{!! $cobertura->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('words.createdAt').':') !!}
    <p>{!! $cobertura->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', trans('words.deletedAt').':') !!}
    <p>{!! $cobertura->deleted_at !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('words.name').':') !!}
    <p>{!! $cobertura->name !!}</p>
</div>

<!-- Clients Id Field -->
<div class="form-group">
    {!! Form::label('clients_id', trans('words.client').':') !!}
    <p>{!! $cobertura->clients_id !!}</p>
</div>

<!-- Dominios Id Field -->
<div class="form-group">
    {!! Form::label('dominios_id', trans('words.dominio').':') !!}
    <p>{!! $cobertura->dominios_id !!}</p>
</div>

<!-- Cobertura Category Id Field -->
<div class="form-group">
    {!! Form::label('cobertura_category_id', trans('dashboard.cobertura.coberturaCategoryId').':') !!}
    <p>{!! $cobertura->cobertura_category_id !!}</p>
</div>

