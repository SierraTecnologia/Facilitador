<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $service->id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('words.updatedAt').':') !!}
    <p>{!! $service->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('words.createdAt').':') !!}
    <p>{!! $service->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', trans('words.deletedAt').':') !!}
    <p>{!! $service->deleted_at !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('words.name').':') !!}
    <p>{!! $service->name !!}</p>
</div>

