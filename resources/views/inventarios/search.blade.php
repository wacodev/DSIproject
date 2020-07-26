{!! Form::open(array('url' => 'inventarios', 'method' => 'GET', 'autocomplete' => 'off', 'role' => 'search')) !!}
  <!-- Fecha -->
  <div class="form-group">
    <div class="input-group">
      {!! Form::text('searchFecha', $searchFecha, ['class' => 'form-control', 'placeholder' => 'dd/mm/yyyy', 'data-inputmask' => '"alias": "dd/mm/yyyy"', 'data-mask']) !!}
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </span>
    </div>
  </div>
{!! Form::close() !!}