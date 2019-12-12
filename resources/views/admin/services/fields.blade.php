<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', trans('words.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('words.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.services.index') !!}" class="btn btn-default">{!! trans('words.cancel') !!}</a>
</div>
