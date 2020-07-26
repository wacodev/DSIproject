@extends('layouts.general')

@section('titulo', 'CEAA | Crear Docente')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('encabezado', 'Crear Docente')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Personal
</li>
<li>
  <a href="{{ route('docentes.index') }}">Docente</a>
</li>
<li class="active">
  Registrar Docente
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Docente</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'docentes.store', 'autocomplete' => 'off', 'method' => 'POST', 'files' => true, 'class' => 'form-horizontal']) !!}
    <div class="box-body">

      <!-- Usuario -->
      <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
        {!! Form::label('user_id', 'Usuario *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un usuario --', 'style' => 'width: 100%', 'required']) !!}
          @if ($errors->has('user_id'))
          <span class="help-block">{{ $errors->first('user_id') }}</span>
          @endif
        </div>
      </div>

      <!-- NIP -->
      <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
        {!! Form::label('nip', 'NIP *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nip', old('nip'), ['class' => 'form-control', 'placeholder' => 'NIP', 'required', 'data-inputmask' => '"mask": "9999999999"', 'data-mask']) !!}
            @if ($errors->has('nip'))
            <span class="help-block">{{ $errors->first('nip') }}</span>
            @endif
        </div>
      </div>

      <!-- NIT -->
      <div class="form-group{{ $errors->has('nit') ? ' has-error' : '' }}">
        {!! Form::label('nit', 'NIT', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nit', old('nit'), ['class' => 'form-control', 'placeholder' => 'NIT', 'data-inputmask' => '"mask": "9999-999999-999-9"', 'data-mask']) !!}
            @if ($errors->has('nit'))
            <span class="help-block">{{ $errors->first('nit') }}</span>
            @endif
        </div>
      </div>

      <!-- NUP -->
      <div class="form-group{{ $errors->has('nup') ? ' has-error' : '' }}">
        {!! Form::label('nup', 'NUP', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('nup', old('nup'), ['class' => 'form-control', 'placeholder' => 'NUP', 'data-inputmask' => '"mask": "999999999999"', 'data-mask']) !!}
            @if ($errors->has('nup'))
            <span class="help-block">{{ $errors->first('nup') }}</span>
            @endif
        </div>
      </div>

      <!-- ISSS -->
      <div class="form-group{{ $errors->has('isss') ? ' has-error' : '' }}">
        {!! Form::label('isss', 'ISSS', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('isss', old('isss'), ['class' => 'form-control', 'placeholder' => 'ISSS', 'data-inputmask' => '"mask": "999999999"', 'data-mask']) !!}
            @if ($errors->has('isss'))
            <span class="help-block">{{ $errors->first('isss') }}</span>
            @endif
        </div>
      </div>

      <!-- Fecha de nacimiento -->
      <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }} input-btn-alinear">
        {!! Form::label('fecha_nacimiento', 'Fecha de nacimiento *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6 input-group">
          {!! Form::text('fecha_nacimiento', old('fecha_nacimiento'), ['class' => 'form-control', 'placeholder' => 'dd/mm/yyyy', 'required', 'data-inputmask' => '"alias": "dd/mm/yyyy"', 'data-mask']) !!}
          @if ($errors->has('fecha_nacimiento'))
          <span class="help-block">{{ $errors->first('fecha_nacimiento') }}</span>
          @endif
        </div>
      </div>

      <!-- Dirección -->
      <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
        {!! Form::label('direccion', 'Dirección', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::textarea('direccion', old('direccion'), ['class' => 'form-control', 'placeholder' => 'Dirección del docente']) !!}
          @if ($errors->has('direccion'))
          <span class="help-block">{{ $errors->first('direccion') }}</span>
          @endif
        </div>
      </div>

      <!-- Teléfono -->
      <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
        {!! Form::label('telefono', 'Teléfono', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('telefono', old('telefono'), ['class' => 'form-control', 'placeholder' => 'Teléfono de contacto', 'data-inputmask' => '"mask": "99999999"', 'data-mask']) !!}
          @if ($errors->has('telefono'))
          <span class="help-block">{{ $errors->first('telefono') }}</span>
          @endif
        </div>
      </div>

      <!-- Formación académica -->
      <div class="form-group{{ $errors->has('estudios') ? ' has-error' : '' }}">
        {!! Form::label('estudios', 'Formación académica', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::textarea('estudios', old('estudios'), ['class' => 'form-control', 'placeholder' => 'Formación académica']) !!}
          @if ($errors->has('estudios'))
          <span class="help-block">{{ $errors->first('estudios') }}</span>
          @endif
        </div>
      </div>

      <!-- Especialidad -->
      <div class="form-group{{ $errors->has('especialidad') ? ' has-error' : '' }}">
        {!! Form::label('especialidad', 'Especialidad', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('especialidad', old('especialidad'), ['class' => 'form-control', 'placeholder' => 'Especialidad del docente']) !!}
          @if ($errors->has('especialidad'))
          <span class="help-block">{{ $errors->first('especialidad') }}</span>
          @endif
        </div>
      </div>

      <!-- Idiomas -->
      <div class="form-group{{ $errors->has('idiomas') ? ' has-error' : '' }}">
        {!! Form::label('idiomas', 'Idiomas', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('idiomas', old('idiomas'), ['class' => 'form-control', 'placeholder' => 'Idiomas del docente']) !!}
          @if ($errors->has('idiomas'))
          <span class="help-block">{{ $errors->first('idiomas') }}</span>
          @endif
        </div>
      </div>

      <!-- Experiencia profesional -->
      <div class="form-group{{ $errors->has('experiencia') ? ' has-error' : '' }}">
        {!! Form::label('experiencia', 'Experiencia profesional', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::textarea('experiencia', old('experiencia'), ['class' => 'form-control', 'placeholder' => 'Experiencia profesional']) !!}
          @if ($errors->has('experiencia'))
          <span class="help-block">{{ $errors->first('experiencia') }}</span>
          @endif
        </div>
      </div>

      <!-- Referencias -->
      <div class="form-group{{ $errors->has('referencias') ? ' has-error' : '' }}">
        {!! Form::label('referencias', 'Referencias', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::textarea('referencias', old('referencias'), ['class' => 'form-control', 'placeholder' => 'Referencias']) !!}
          @if ($errors->has('referencias'))
          <span class="help-block">{{ $errors->first('referencias') }}</span>
          @endif
        </div>
      </div>

      <!-- Imagen -->
      <div class="form-group{{ $errors->has('imagen') ? ' has-error' : '' }}">
        {!! Form::label('imagen', 'Imagen', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::file('imagen', ['class' => 'input-alinear']) !!}
          @if ($errors->has('imagen'))
          <span class="help-block">{{ $errors->first('imagen') }}</span>
          @endif
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('docentes.index') }}" class="btn btn-default btn-flat">Cancelar</a>
          {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-flat']) !!}
        </div>
      </div>
    </div>
  {!! Form::close() !!}
  <!-- /.box-footer-->
</div>
<!-- /.box -->
@endsection

@section('scripts')
<!-- InputMask -->
<script src="{{ asset('js/jquery.inputmask.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.date.extensions.js') }}"></script>
<script type="text/javascript">
  $(function () {
    $('[data-mask]').inputmask()
  })
</script>
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endsection