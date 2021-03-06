<!--- Venue Field --->
<div class="form-group col-sm-6">
    {!! Form::label('venue', 'Venue:') !!}
    {!! Form::text('venue', null, ['class' => 'form-control']) !!}
</div>

<!--- Address Field --->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('venues.index') !!}" class="btn btn-default">Cancel</a>
</div>
