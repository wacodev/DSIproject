@extends('layouts.general')

@section('titulo', 'CEAA | Ver Docente')

@section('encabezado', 'Ver Docente')

@section('subencabezado', 'Detalle')

@section('breadcrumb')
<li>
  <i class="fa fa-users"></i> Personal
</li>
<li>
  <a href="{{ route('docentes.index') }}">Docente</a>
</li>
<li class="active">
  Ver Docente
</li>
@endsection

@section('contenido')
<section class="invoice" style="margin-left: 0; margin-right: 0">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        {{ $docente->user->nombre }} {{ $docente->user->apellido }}
        <img src="{{ asset('img/docentes/' . $docente->imagen) }}" class="pull-left" style="width: 175px; height:175px; margin-right: 15px" />
        <small><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($docente->fecha_nacimiento)->format('d/m/Y') }}</small>
        <small><strong>DUI:</strong> {{ $docente->user->dui }}</small>
        <small><strong>NIP:</strong> {{ $docente->nip }}</small>
        <small><strong>NIT:</strong> {{ $docente->nit }}</small>
        <small><strong>NUP:</strong> {{ $docente->nup }}</small>
        <small><strong>ISSS:</strong> {{ $docente->isss }}</small>
        <small><strong>Teléfono:</strong> {{ $docente->telefono }}</small>
        <small><strong>Dirección:</strong> {{ $docente->direccion }}</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <h4>Formación Académica</h4>
      @if ($docente->especialidad)
      <p><strong>Especialidad: </strong> {{ $docente->especialidad }}</p>
      @endif
      <p>{{ $docente->estudios }}</p>
      <br>
      <h4>Experiencia Profesional</h4>
      <p>{{ $docente->experiencia }}</p>
      <br>
      @if ($docente->idioma)
      <h4>Idiomas</h4>
      <p>{{ $docente->idiomas }}</p>
      <br>
      @endif
      <h4>Referencias</h4>
      <p>{{ $docente->referencias }}</p>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  
  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">
      <button type="button" class="btn btn-primary btn-flat pull-right" onclick="window.print()">
        <i class="fa fa-print" style="margin-right: 3px;"></i> Imprimir
      </button>
    </div>
  </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>
@endsection