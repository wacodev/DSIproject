@extends('layouts.login')

@section('titulo', 'CEAA | Restablecer Contraseña')

@section('login-msg', 'Restablecer Contraseña')

@section('formulario')
@if (session('status'))
<div class="alert alert-success" role="alert">
  {{ session('status') }}
</div>
<br>
@endif
<form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
  @csrf
  <div class="form-group has-feedback">
    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Correo electrónico" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
    <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
    @endif
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar enlace para restablecer contraseña</button>
    </div>
    <!-- /.col -->
  </div>
</form>
@endsection
