@extends('layouts.app')

@section('content')
    @role('encargado')
    @if(Session::has('notification'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{Session::get('notification')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card_header_login_register">{{ __('Crear Usuario') }}</div>

                <div class="card-body ">
                    <form method="POST" action="{{ route('crear_usu') }}" class="mform1" id="mform1" >
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-center">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-center">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('name') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Dni') }}</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autocomplete="dni">

                                @error('dni')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Cuerpo') }}</label>

                                <div class="col-md-6">
                                    <select name='body' class="form-control">
                                        @foreach ($enseñanzas as $enseñanza)
                                            <option value="{{$enseñanza->id}}">{{$enseñanza->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Codigo del centro') }}</label>

                            <div class="col-md-6">
                                <input id="center_code" type="number" class="form-control @error('center_code') is-invalid @enderror" name="center_code" value="{{ old('center_code') }}" required autocomplete="center_code">

                                @error('center_code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-center">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-center">{{ __('Confirma Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div style="display: flex;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_user" id="flexRadioDefault1" value="profesor">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Profesor
                                </label>
                            </div>
                            <div class="form-check" style="margin-left: 5%">
                                <input class="form-check-input" type="radio" name="tipo_user" id="flexRadioDefault2" checked value="encargado">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Encargado
                                </label>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="id_submitbutton" type="submit" class="btn btn-secondary">
                                    {{ __('Crear Usuario') }}
                                </button>
                                <button type="button" class="btn btn-link" style="background-color: #22A39F!important;">
                                    <a style="color: white" href="{{route('listado_usu')}}">
                                        Volver Atras
                                    </a>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @endrole
    @role('profesor')
    <h2>No tiene permisos para estar aquí</h2>
    <a href="/home">Volver al inicio</a>
    @endrole

@section('js')
    <!-- <script src={{asset('js/validar.js')}}></script> -->
@endsection

@endsection
