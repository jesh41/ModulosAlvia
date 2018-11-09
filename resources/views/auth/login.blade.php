@extends('layouts.login')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="card-body">
                                <h1>Acceder</h1>
                                <p class="text-muted">Control de acceso al sistema</p>
                                <div class="form-group mb-3">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group mb-4">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                    <div lass="row">
                                        <div class="col-6">
                                            <div class="form-check checkbox">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <div class="col-6 text-right">
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                                </div>
                                            </div>
                                        </div>
                                     </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit"> {{ __('Login') }}</button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a class="btn btn-link px-0" href="{{ route('password.request') }}" >{{ __('Forgot Your Password?') }}</a>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <h2>Sistema de Ventas IncanatoIT</h2>
                                <p>Sistema de compras, Ventas desarrollado en PHP utilizando el Framework Laravel y Vue Js, con el gestor de base de datos MariaDB.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
