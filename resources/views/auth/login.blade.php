@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card_header_login_register">{{ __('Iniciar Sesión') }}</div>

                <div class="card-body card_login_register">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-center">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-3 col-form-label text-md-center">{{ __('Contraseña') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md offset-md" style="display: flex;justify-content: center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar sesión') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                            <div class="col-md-3 text-md-center" style="display: flex;justify-content: center">

                                <button type="submit" class="btn" style="background-color: #22A39F!important;color: white">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                            </div>

                        <hr>

                        <p class="h5" style="display: flex;justify-content: center">¿No tienes cuenta? Registrate <a style="margin-left: 3px" class="btn-link" href="{{route('register')}}"> aquí </a></p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
