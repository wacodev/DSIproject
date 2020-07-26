@extends('layouts.general')

@section('titulo', 'CEAA | Editar Grado')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('encabezado', 'Editar Grado')

@section('subencabezado', 'Editar')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Gestión Académica
</li>
<li>
  <a href="{{ route('grados.index') }}">Grado</a>
</li>
<li class="active">
  Editar Grado
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Grado</h3>
  </div>
  <!-- Formulario -->
 {!! Form::open(['route' => ['grados.update', $grado], 'autocomplete' => 'off', 'method' => 'PUT', 'files' => true, 'class' => 'form-horizontal']) !!}
    <div class="box-body">

      <!-- Nivel Academico -->
      <div class="form-group{{ $errors->has('nivel_id') ? ' has-error' : '' }}">
        {!! Form::label('nivel_id>', 'Nivel educativo *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('nivel_id', $niveles, $grado->nivel_id,  ['class' => 'form-control select2', 'disabled', 'placeholder' => '-- Seleccione un nivel educativo --', 'style' => 'width: 100%', 'required']) !!}
          @if ($errors->has('nivel_id'))
          <span class="help-block">{{ $errors->first('nivel_id') }}</span>
          @endif
        </div>
      </div>

     <!-- Anio -->
      <div class="form-group{{ $errors->has('anio_id') ? ' has-error' : '' }}">
        {!! Form::label('numero>', 'Año escolar *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('anio_id', $anios, $grado->anio_id, ['class' => 'form-control select2', 'disabled', 'placeholder' => '-- Seleccione un año --', 'style' => 'width: 100%', 'required']) !!}
          @if ($errors->has('anio_id'))
          <span class="help-block">{{ $errors->first('anio_id') }}</span>
          @endif
        </div>
      </div>

      <!-- Código -->
      <div class="form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
        {!! Form::label('Codigo', 'Código', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('codigo', $grado->codigo, ['class' => 'form-control', 'placeholder' => 'Código del grado', 'required', 'disabled']) !!}
            @if ($errors->has('codigo'))
            <span class="help-block">{{ $errors->first('codigo') }}</span>
            @endif
        </div>
      </div>

      <!-- Sección -->
      <div class="form-group{{ $errors->has('seccion') ? ' has-error' : '' }}">
        {!! Form::label('Seccion', 'Sección', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('seccion', $grado->seccion, ['class' => 'form-control', 'placeholder' => 'Sección ', 'required', 'disabled']) !!}
            @if ($errors->has('seccion'))
            <span class="help-block">{{ $errors->first('seccion') }}</span>
            @endif
        </div>
      </div>

      <!-- Docente orientador -->
      <div class="form-group{{ $errors->has('docente_id') ? ' has-error' : '' }}">
        {!! Form::label('docente_id', 'Docente orientador', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::select('docente_id', $docentes, $grado->docente_id, ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un docente orientador --', 'style' => 'width: 100%', 'required']) !!}
          @if ($errors->has('docente_id'))
          <span class="help-block">{{ $errors->first('docente_id') }}</span>
          @endif
        </div>
      </div>

      <!-- Materias -->
      <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-quitar-margen">
              <thead>
                <tr>
                  <th>Materia</th>
                  <th>Docente</th>
                </tr>
              </thead>
              <tbody>
                @foreach($materias as $materia)
                <tr>
                  <td>
                    {!! Form::hidden('materias[]', $materia->id, ['class' => 'form-control', 'placeholder' => 'Seccion ', 'required']) !!}
                    {{ $materia->codigo }} - {{ $materia->nombre }}
                  </td>
                  <td>
                    {!! Form::select('docentes[]', $docentes, $materia->pivot->docente_id, ['class' => 'form-control select2', 'placeholder' => '-- Seleccione un docente --', 'style' => 'width: 100%']) !!}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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