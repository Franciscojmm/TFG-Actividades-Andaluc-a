@extends('layouts.app')

@section('content')
@role('encargado')
    @if(Session::has('notification'))
        <div class="col-lg-8 alert alert-primary" role="alert">
            {{Session::get('notification')}}
        </div>
    @endif



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card_header_login_register">{{ __('Editar datos del Usuario') }}</div>

                    <div class="card-body ">
                        <form method="POST" action="{{ route('guardar_datos_usu') }}" >
                            @csrf
                            <input type="hidden" name="id" value="{{$usu->id}}">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-center">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usu->name }}" required autocomplete="name" autofocus>

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
                                    <input id="surname" type="text" class="form-control @error('name') is-invalid @enderror" name="surname" value="{{ $usu->surname }}" required autocomplete="name" autofocus>

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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usu->email }}" required autocomplete="email">

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
                                    <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ $usu->dni }}" required autocomplete="dni">

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
                                        <option value="{{$usu->body}}">{{$usu->teachings->name}}</option>
                                    @foreach ($enseñanzas as $enseñanza)
                                        <option value="{{$enseñanza->id}}">{{$enseñanza->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Codigo del centro') }}</label>

                                <div class="col-md-6">
                                    <input id="center_code" type="number" class="form-control @error('center_code') is-invalid @enderror" name="center_code" value="{{ $usu->center_code }}" required autocomplete="center_code">

                                    @error('center_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-center">{{ __('Rol') }}</label>

                                <div class="col-md-6">
                                    @if($usu->hasRole('profesor'))
                                    <input id="rol" type="text" class="form-control" name="rol" required autocomplete="new-password" disabled value="Profesor">
                                    @else
                                    <input id="rol" type="text" class="form-control" name="rol" required autocomplete="new-password" disabled value="Encargado">
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="id_submitbutton" type="submit" class="btn btn-confirm">
                                        {{ __('Actualizar Datos') }}
                                    </button>

                                        <a class="btn btn-secondary" href="{{route('listado_usu')}}">
                                            Volver Atras
                                        </a>

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
@endsection
