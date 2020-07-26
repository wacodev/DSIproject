@extends('layouts.general')

@section('titulo', 'CEAA | Alumnos')

@section('encabezado', 'Alumnos')

@section('subencabezado', 'Récord de notas')

@section('breadcrumb')
<li>
  <i class="fa fa-child"></i>
  <a href="{{ route('alumnos.index') }}">Alumnos</a>
</li>
<li class="active">
  Récord de notas
</li>
@endsection

@section('contenido')
<div class="row">
  <div class="col-sm-4 no-print">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <h3 class="profile-username text-center">{{ $alumno->nombre }} {{ $alumno->apellido }}</h3>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>NIE</b> <a class="pull-right">{{ $alumno->nie }}</a>
          </li>
          <li class="list-group-item">
            <b>Género</b> <a class="pull-right">@if ($alumno->genero == 'F') Femenino @else Masculino @endif</a>
          </li>
          <li class="list-group-item">
            <b>Fecha de nacimiento</b> <a class="pull-right">{{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d/m/Y') }}</a>
          </li>
          <li class="list-group-item">
            <b>Teléfono</b> <a class="pull-right">{{ $alumno->telefono }}</a>
          </li>
          <li class="list-group-item">
            <b>Departamento</b> <a class="pull-right">{{ $alumno->municipio->departamento->nombre }}</a>
          </li>
          <li class="list-group-item">
            <b>Municipio</b> <a class="pull-right">{{ $alumno->municipio->nombre }}</a>
          </li>
          <li class="list-group-item">
            <b>Dirección</b> <a class="pull-right">{{ $alumno->direccion }}</a>
          </li>
          <li class="list-group-item">
            <b>Responsable</b> <a class="pull-right">{{ $alumno->responsable }}</a>
          </li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- Lista de grados en que se ha matriculado el alumno -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Grados</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <!-- Lista de materias -->
        <ul class="nav nav-stacked">
          <li><a href="{{ route('alumnos.record', [$alumno->id, 0]) }}" class="product-title">Resumen general</a></li>
          @foreach ($matriculas as $matricula)
          <li><a href="{{ route('alumnos.record', [$alumno->id, $matricula->grado->id]) }}" class="product-title">{{ $matricula->grado->codigo }}</a></li>
          @endforeach
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>

  <div class="col-sm-8">
    <section class="invoice" style="margin-left: 0; margin-right: 0; margin-top: 0;">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Récord de notas
            <small class="pull-right">Fecha: {{ $hoy }}</small>
            <img src="{{ asset('img/sistema/logo_ceaa.png') }}" class="pull-left" style="width: 77px; height:101px; margin-right: 15px" />
            <small>Resumen general de rendimiento académico</small>
            <small>Centro Escolar Anastasio Aquino, Código 12053</small>
            <small>Cantón San Antonio Abajo, Santiago Nonualco</small>
            <small>Departamento La Paz, Distrito 08-07</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>NIE</th>
              <th>APELLIDO</th>
              <th>NOMBRE</th>
              <th>GÉNERO</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>{{ $alumno->nie }}</td>
              <td>{{ $alumno->apellido }}</td>
              <td>{{ $alumno->nombre }}</td>
              <td>@if ($alumno->genero == 'F') Femenino @else Masculino @endif</td>
            </tr>
            </tbody>
          </table>
        </div>

        @for ($i = 0; $i < count($matriculas); $i++)
        <h4 class="text-center">{{ $matriculas[$i]->grado->codigo }}</h4>
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
              <tr>
                <th class="text-center" colspan="3">ASIGNATURAS</th>
              </tr>
              <tr>
                <th style="width: 100px;">CÓDIGO</th>
                <th>NOMBRE</th>
                <th style="width: 100px;">NOTA FINAL</th>
              </tr>
              @for ($j = 0; $j < count($materias[$i]); $j++)
              <tr>
                <td style="width: 100px;">{{ $materias[$i][$j]->codigo }}</td>
                <td>{{ $materias[$i][$j]->nombre}}</td>
                <td style="width: 100px;">{{ $promedios_materias[$i][$j] }}</td>
              </tr>
              @endfor
              <tr>
                <th class="text-center" colspan="3">EDUCACIÓN MORAL Y CÍVICA</th>
              </tr>
              <tr>
                <th colspan="2">VALOR</th>
                <th style="width: 100px;">NOTA FINAL</th>
              </tr>
              @for ($k = 0; $k < count($valores); $k++)
              <tr>
                <td colspan="2">{{ $valores[$k]->valor }}</td>
                <td style="width: 100px;">{{ $promedios_conducta[$i][$k] }}</td>
              </tr>
              @endfor
          </table>
        </div>
        @endfor
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
  </div>
</div>
@endsection