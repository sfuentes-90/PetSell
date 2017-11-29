@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar Usuario</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6"><input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6"><input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }}">
                            <label for="rut" class="col-md-4 control-label">RUT</label>
                            <div class="col-md-6"><input id="rut" type="text" class="form-control" name="rut" value="{{ old('rut') }}" required>
                                @if ($errors->has('rut'))
                                    <span class="help-block"><strong>{{ $errors->first('rut') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">Telefono</label>
                            <div class="col-md-6"><input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
                                @if ($errors->has('telefono'))
                                    <span class="help-block"><strong>{{ $errors->first('telefono') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('banco') ? ' has-error' : '' }}">
                            <label for="banco" class="col-md-4 control-label">Banco</label>
                            <div class="col-md-6">
                              <select id="banco" class="form-control" name="banco" selected="{{ old('banco') }}">
                                  <option value="Banco Estado">Banco Estado</option>
                                  <option value="BCI">BCI</option>
                                  <option value="Banco de Chile">Banco de Chile</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cuenta') ? ' has-error' : '' }}">
                            <label for="cuenta" class="col-md-4 control-label">N° Cuenta</label>
                            <div class="col-md-6"><input id="cuenta" type="text" class="form-control" name="cuenta" value="{{ old('cuenta') }}">
                                @if ($errors->has('cuenta'))
                                    <span class="help-block"><strong>{{ $errors->first('cuenta') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6"><input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6"><input id="password-confirm" type="password" class="form-control" name="password_confirmation" required></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">&nbsp;</label>
                            <div class="col-md-6"><label><input type="checkbox" value="">Acepto los terminos y condiciones</label></div>
                        </div>
                        <div class="form-group"><div class="col-md-6 col-md-offset-4"><button type="submit" class="btn btn-primary">Registrar</button></div></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
