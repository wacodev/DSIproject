{!! Form::open(array('route' => ['notas.ranking', $grado->id], 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search', 'class' => 'form-inline')) !!}
  <!-- Trimestre -->
  <div class="form-group">
    <div class="input-group">
      {!! Form::select('tipo', ['0' => 'Anual', '1' => 'Trimestre 1', '2' => 'Trimestre 2', '3' => 'Trimestre 3'], $tipo, ['class' => 'form-control', 'placeholder' => '-- Seleccione un ranking --'] ) !!}
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default btn-flat">
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </button>
      </span>
    </div>
  </div>
{!! Form::close() !!}