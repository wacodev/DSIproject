@extends('layouts.general')

@section('titulo', 'CEAA | Inventarios')

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('encabezado', 'Inventarios')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li>
  <i class="fa fa-cubes"></i>
  <a href="{{ route('inventarios.index') }}"> Inventarios</a>
</li>
<li class="active">
  Inventario ({{ \Carbon\Carbon::parse($inventario->fecha)->format('d/m/Y') }})
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Inventario ({{ \Carbon\Carbon::parse($inventario->fecha)->format('d/m/Y') }})</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-8">
        <!-- Formulario de registro -->
        @include('inventarios.create2')
      </div>
      <div class="col-sm-4">
      	<!-- Barra de búsqueda -->
      	@include('inventarios.search2')
      </div>
    </div>
  	<!-- Listado de recursos incluidos en el inventario -->
  	@if ($recursos_inventario->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Recurso</th>
            <th>Cantidad</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recursos_inventario as $recurso)
          <tr>
            <td>{{ $recurso->nombre }}</td>
            <td>{{ $recurso->cantidad }}</td>
            <td>
              <a href="" data-target="#modal-delete-{{ $recurso->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('inventarios.modal2')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay recursos en el inventario -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron recursos en el inventario</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $recursos_inventario->render() !!}
    </div>
  </div>
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