<div class="form-group col-sm-6">
    {!! Form::label('name', $settingRules['name'].':') !!}
    @if ($settingRules['options'] == 'string')
        {!! Form::text('value', $settingRules['defaultValue'], ['placeholder' => $settingRules['description']]) !!}
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('words.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! URL::previous() !!}" class="btn btn-default">{!! trans('words.cancel') !!}</a>
</div>
