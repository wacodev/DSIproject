@extends('layouts.general')

@section('titulo', 'CEAA | Inventarios')

@section('encabezado', 'Inventarios')

@section('subencabezado', 'Edición')

@section('breadcrumb')
<li>
  <i class="fa fa-cubes"></i>
  <a href="{{ route('inventarios.index') }}">Inventarios</a>
</li>
<li class="active">
  Editar Inventario
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Editar Inventario</h3>
  </div>
  <!-- Formulario -->
  {!! Form::open(['route' => ['inventarios.update', $inventario], 'autocomplete' => 'off', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    <div class="box-body">
      <!-- Fecha -->
      <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }} input-btn-alinear">
        {!! Form::label('fecha', 'Fecha', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6 input-group">
          {!! Form::text('fecha', \Carbon\Carbon::parse($inventario->fecha)->format('d/m/Y'), ['class' => 'form-control', 'placeholder' => 'dd/mm/yyyy', 'required', 'data-inputmask' => '"alias": "dd/mm/yyyy"', 'data-mask']) !!}
          @if ($errors->has('fecha'))
          <span class="help-block">{{ $errors->first('fecha') }}</span>
          @endif
          <span class="input-group-btn">
            <a href="#" class="btn btn-default btn-flat" id="btn_fecha"><i class="fa fa-calendar"></i></a>
          </span>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-9">
        <div class="pull-right">
          <a href="{{ route('inventarios.index') }}" class="btn btn-default btn-flat">Cancelar</a>
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
    // Máscaras.
    $('[data-mask]').inputmask()
  })
</script>
<script type="text/javascript">
  (function () {
    // Fecha actual.
    var fechaActual = function() {
      document.getElementById("fecha").value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}";
    };
    var btn_fecha = document.getElementById('btn_fecha');
    btn_fecha.addEventListener('click', fechaActual);
    // Hora de entrada actual.
    var horaEntradaActual = function() {
      document.getElementById("hora_entrada").value="{{ \Carbon\Carbon::now()->format('H:i:s') }}";
    };
    var btn_hora_entrada = document.getElementById('btn_hora_entrada');
    btn_hora_entrada.addEventListener('click', horaEntradaActual);
    
    // Hora de salida actual.
    var horaSalidaActual = function() {
      document.getElementById("hora_salida").value="{{ \Carbon\Carbon::now()->format('H:i:s') }}";
    };
    var btn_hora_salida = document.getElementById('btn_hora_salida');
    btn_hora_salida.addEventListener('click', horaSalidaActual);
  }())
</script>
@endsection