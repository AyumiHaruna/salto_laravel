@extends('layouts.mainLayout')

@section('title') Restaurar contraseña @endsection

@section('extraheader')
  <link rel="stylesheet" href="{{ asset('css/auth/style.css') }}">
@endsection

@section('content')
  <div class="container-fluid" style="background-image: url('{{ asset('img/web/admin_elements/degradado_registro2.png') }}');" id="mainContainer">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="col-md-8 offset-md-2" id="formContainer">
          <div class="panel panel-default">
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                      {{ csrf_field() }}

                      <div class="plain_title">
                          Restaurar Contraseña
                      </div>

                      <input type="hidden" name="token" value="{{ $token }}">

                      <div class="input-group mb-4 {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group-prepend">
                          <label for="email" class="input-group-text" id="basic-addon1"> <img src="{{asset('img/web/admin_elements/icono_mail.png')}}" alt=""> </label>
                        </div>
                        <input type="email" id="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Correo Electrónico" aria-label="Username" aria-describedby="basic-addon1" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>


                      <div class="input-group mb-4 {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-group-prepend">
                          <label for="password" class="input-group-text" id="basic-addon1"> <img src="{{asset('img/web/admin_elements/icono_candado.png')}}" alt=""> </label>
                        </div>
                        <input type="password" id="password" class="form-control" name="password" value="{{ old('email') }}" placeholder="Contraseña" aria-label="Password" aria-describedby="basic-addon2" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                      </div>

                      <div class="input-group mb-4 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="input-group-prepend">
                          <label for="password-confirm" class="input-group-text" id="basic-addon1"> <img src="{{asset('img/web/admin_elements/icono_candado.png')}}" alt=""> </label>
                        </div>
                        <input type="password" id="password-confirm" class="form-control" name="password-confirm" placeholder="Verificar Contraseña" aria-label="password-confirm" aria-describedby="basic-addon2" required>
                        @if ($errors->has('password-confirm'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password-confirm') }}</strong>
                            </span>
                        @endif
                      </div>


                      <div class="form-group">
                          <div class="col-md-12 text-center">
                              <button type="submit" name="button" class="btn_submit" style="background-image: url('{{ asset('img/web/admin_elements/boton_inciar-sesion.png') }}')">
                                Iniciar Sesión
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
