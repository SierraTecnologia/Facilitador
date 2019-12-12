<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $contact->id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('words.updatedAt').':') !!}
    <p>{!! $contact->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('words.createdAt').':') !!}
    <p>{!! $contact->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', trans('words.deletedAt').':') !!}
    <p>{!! $contact->deleted_at !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $contact->title !!}</p>
</div>

<!-- Contactcol Field -->
<div class="form-group">
    {!! Form::label('contactcol', 'Contactcol:') !!}
    <p>{!! $contact->contactcol !!}</p>
</div>

<!-- Email Id Field -->
<div class="form-group">
    {!! Form::label('email_id', 'Email Id:') !!}
    <p>{!! $contact->email_id !!}</p>
</div>

<!-- Service Id Field -->
<div class="form-group">
    {!! Form::label('service_id', 'Service Id:') !!}
    <p>{!! $contact->service_id !!}</p>
</div>

<!-- Clients Id Field -->
<div class="form-group">
    {!! Form::label('clients_id', 'Clients Id:') !!}
    <p>{!! $contact->clients_id !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $contact->description !!}</p>
</div>

