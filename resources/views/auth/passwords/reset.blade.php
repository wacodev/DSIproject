@extends('layouts.login')

@section('titulo', 'CEAA | Restablecer Contraseña')

@section('login-msg', 'Restablecer Contraseña')

@section('formulario')
<form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <div class="form-group has-feedback">
    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Correo electrónico" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
    <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
    @endif
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" name="password" required>
    @if ($errors->has('password'))
    <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
    @endif
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input id="password-confirm" type="password" class="form-control" placeholder="Confirmar contraseña" name="password_confirmation" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Restablecer contraseña</button>
    </div>
    <!-- /.col -->
  </div>
</form>
@endsection
