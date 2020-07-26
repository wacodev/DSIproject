{!! Form::open(['route' => ['inventarios.store2', $inventario->id], 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-inline']) !!}
<!-- Recurso -->
<div class="form-group{{ $errors->has('recurso_id') ? ' has-error' : '' }}">
  {!! Form::label('recurso_id', 'Recurso', ['class' => 'control-label']) !!}
  &nbsp;
  {!! Form::select('recurso_id', $recursos, old('recurso_id'), ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un recurso --', 'required']) !!}
  @if ($errors->has('recurso_id'))
  <span class="help-block">{{ $errors->first('recurso_id') }}</span>
  @endif
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- Cantidad -->
<div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
  {!! Form::label('cantidad', 'Cantidad', ['class' => 'control-label']) !!}
  &nbsp;
  {!! Form::number('cantidad', old('cantidad'), ['class' => 'form-control', 'placeholder' => 'Cantidad', 'required']) !!}
  @if ($errors->has('cantidad'))
  <span class="help-block">{{ $errors->first('cantidad') }}</span>
  @endif
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{!! Form::submit('Registrar', ['class' => 'btn btn-primary btn-flat']) !!}
{!! Form::close() !!}