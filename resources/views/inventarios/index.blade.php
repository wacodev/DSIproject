@extends('layouts.general')

@section('titulo', 'CEAA | Inventarios')

@section('encabezado', 'Inventarios')

@section('subencabezado', 'Gestión')

@section('breadcrumb')
<li class="active">
  <i class="fa fa-cubes"></i> Inventarios
</li>
@endsection

@section('contenido')
<!-- Box Primary -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Gestión de Inventarios</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ route('inventarios.create') }}" class="btn btn-primary btn-flat">Registrar inventario</a>
      </div>
      <div class="col-sm-6">
      	<!-- Barra de búsqueda -->
      	@include('inventarios.search')
      </div>
    </div>
  	<!-- Listado de inventarios -->
  	@if ($inventarios->count() > 0)
  	<div class="table-responsive">
      <table class="table table-hover table-striped table-bordered table-quitar-margen">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($inventarios as $inventario)
          <tr>
            <td>{{ \Carbon\Carbon::parse($inventario->fecha)->format('d/m/Y') }}</td>
            <td>
              <a href="{{ route('inventarios.show', $inventario->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>
              <a href="{{ route('inventarios.edit', $inventario->id) }}" class="btn btn-default btn-flat">
                <i class="fa fa-wrench" aria-hidden="true"></i>
              </a>
              <a href="" data-target="#modal-delete-{{ $inventario->id }}" data-toggle="modal" class="btn btn-danger btn-flat">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          <!-- Modal para dar de baja -->
          @include('inventarios.modal')
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Si no hay inventarios -->
    @else
      <div class="text-center">
        <i class="fa fa-search fa-5x" aria-hidden="true"></i>
        <h4>No se encontraron inventarios</h4>
      </div>
    @endif
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="pull-right">
    	<!-- Paginación -->
      {!! $inventarios->render() !!}
    </div>
  </div>
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
@endsection