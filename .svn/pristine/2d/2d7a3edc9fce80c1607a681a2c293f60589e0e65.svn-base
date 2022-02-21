@extends('layouts.mainLayout')

  @section('title') Registro @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/auth/style.css') }}">
  @endsection

@section('content')
<div class="container-fluid" style="background-image: url('{{ asset('img/web/saltum_back01.png') }}');">
    <div class="row">
        <div class="col-md-6 offset-md-3"  id="mainContainer">
            <div class="row">
              <div class="col-md-12 text-center" id="title1">
                Registrar
              </div>
              <div class="col-md-12 text-center" id="title2">
                Usuario
              </div>
            </div>

            <div class="col-md-8 offset-md-2" id="formContainer">
              <div class="panel panel-default">

                  <div class="panel-body">
                      <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="col-md-12 control-label">Nombre</label>

                              <div class="col-md-12">
                                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                  @if ($errors->has('name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label for="email" class="col-md-12 control-label">Correo</label>

                              <div class="col-md-12">
                                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                              <label for="password" class="col-md-12 control-label">Contraseña</label>

                              <div class="col-md-12">
                                  <input id="password" type="password" class="form-control" name="password" required>

                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="password-confirm" class="col-md-12 control-label">Confirmar Contraseña</label>

                              <div class="col-md-12">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-12">
                                  <button type="submit" class="btn btn-block btn-primary">
                                      Registrar
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
