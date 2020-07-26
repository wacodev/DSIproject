@extends('layouts.general')

@section('titulo', 'CEAA | Ranking')

@section('encabezado', $grado->codigo)

@section('breadcrumb')
<li>
  <i class="fa fa-star"></i>
  <a href="{{ route('notas.index') }}">Notas</a>
</li>
<li class="active">Ranking</li>
@endsection

@section('contenido')
<div class="row no-print">
  <div class="col-xs-12">
  	<!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li><a href="{{ route('conducta.edit', $grado->id) }}">Notas de Conducta</a></li>
        <li class="active"><a href="{{ route('notas.create-reporte', $grado->id) }}">Ranking</a></li>
        <li><a href="{{ route('notas.create-reporte', $grado->id) }}">Reporte de Notas</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active">
          <div class="row">
            <div class="col-sm-12">
              <ol class="breadcrumb">
                <li>
                  <strong>Año:</strong> {{ $grado->anio->numero }}
                </li>
                <li>
                  <strong>Grado:</strong> {{ $grado->codigo }}
                </li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <button type="button" class="btn btn-primary btn-flat pull-right" onclick="window.print()">
                <i class="fa fa-print" style="margin-right: 3px;"></i> Imprimir
              </button>
              <!-- Barra de búsqueda -->
    		  @include('notas.search-ranking')
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
</div>

<!-- Reporte -->
<section class="invoice" style="margin-left: 0; margin-right: 0">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        Ranking de Rendimiento Escolar
        <small class="pull-right">Fecha: {{ $hoy }}</small>
        <img src="{{ asset('img/sistema/logo_ceaa.png') }}" class="pull-left" style="width: 77px; height:101px; margin-right: 15px" />
        @if ($tipo == 0)
        <small>Ranking Anual de {{ $grado->nivel->nombre }}@if ($grado->seccion), Sección "{{ $grado->seccion }}" @endif</small>
        @else
        <small>Ranking del Trimestre {{ $tipo }} de {{ $grado->nivel->nombre }}@if ($grado->seccion), Sección "{{ $grado->seccion }}" @endif</small>
        @endif
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
          	<th style="text-align: center; width: 80px;">Medalla</th>
          	<th style="text-align: center; width: 80px;">Posición</th>
          	<th>Alumno</th>
          	<th style="text-align: center; width: 80px;">Promedio</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($promedios as $i => $promedio)
          <tr>
          	@if ($posicion == 1)
          	<td style="text-align: center;"><img src="{{ asset('img/sistema/medalla_1.jpg') }}" style="height: 20px" /></td>
          	@elseif ($posicion == 2)
          	<td style="text-align: center;"><img src="{{ asset('img/sistema/medalla_2.jpg') }}" style="height: 20px" /></td>
          	@elseif ($posicion == 3)
          	<td style="text-align: center;"><img src="{{ asset('img/sistema/medalla_3.jpg') }}" style="height: 20px" /></td>
          	@else
          	<td></td>
          	@endif
            <td style="text-align: center;">{{ $posicion++ }}</td>
            <td>{{ $matriculas[$i]->alumno->apellido }}, {{ $matriculas[$i]->alumno->nombre }}</td>
            <td style="text-align: center;">{{ $promedio }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<div class="clearfix"></div>
@endsection