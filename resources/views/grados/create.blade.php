@extends('layouts.general')

@section('titulo', 'CEAA | Crear Grado')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('encabezado', 'Crear Grado')

@section('subencabezado', 'Registro')

@section('breadcrumb')
<li>
  <i class="fa fa-graduation-cap"></i>
  <a href="{{ route('grados.index') }}">Grado</a>
</li>
<li class="active">
  Registrar Grado
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Registrar Grado</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => 'grados.store', 'autocomplete' => 'off', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <div class="box-body">

      <!-- Nivel Académico -->
      <div class="form-group{{ $errors->has('nivel_id') ? ' has-error' : '' }}">
        {!! Form::label('nivel_id>', 'Nivel educativo *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('nivel_id', $niveles, old('nivel_id'), ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un nivel educativo --', 'style' => 'width: 100%', 'required']) !!}
          @if ($errors->has('nivel_id'))
          <span class="help-block">{{ $errors->first('nivel_id') }}</span>
          @endif
        </div>
      </div>

     <!-- Anio -->
      <div class="form-group{{ $errors->has('anio_id') ? ' has-error' : '' }}">
        {!! Form::label('numero>', 'Año escolar *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('anio_id', $anios, old('anio_id'), ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un año --', 'style' => 'width: 100%', 'required']) !!}
          @if ($errors->has('anio_id'))
          <span class="help-block">{{ $errors->first('anio_id') }}</span>
          @endif
        </div>
      </div>

      <!-- Sección -->
      <div class="form-group{{ $errors->has('seccion') ? ' has-error' : '' }}">
        {!! Form::label('seccion', 'Sección', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('seccion', old('seccion'), ['class' => 'form-control', 'placeholder' => 'Sección ']) !!}
            @if ($errors->has('seccion'))
            <span class="help-block">{{ $errors->first('seccion') }}</span>
            @endif
        </div>
      </div>

      <!-- Docente orientador -->
      <div class="form-group{{ $errors->has('docente_id') ? ' has-error' : '' }}">
        {!! Form::label('docente_id', 'Docente orientador *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('docente_id', $docentes, old('docente_id'), ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un docente orientador --', 'style' => 'width: 100%', 'required']) !!}
          @if ($errors->has('docente_id'))
          <span class="help-block">{{ $errors->first('docente_id') }}</span>
          @endif
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('grados.index') }}" class="btn btn-default btn-flat">Cancelar</a>
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
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endsection