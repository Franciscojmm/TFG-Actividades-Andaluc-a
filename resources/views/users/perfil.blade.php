@extends('layouts.app')

@section('content')

    @if(Session::has('notification'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{Session::get('notification')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 style="padding-left: 18%"> Datos de mi perfil </h2>

    <div class="row text-center animate__animated animate__fadeInLeft">

        <div class="col-md-8">

            <div class="card-body">
                <form method="POST" action="{{ route('guardar_perfil') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                        <div class="col-md-7">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usu->name }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Apellidos') }}</label>

                        <div class="col-md-7">
                            <input id="surname" type="text" class="form-control @error('name') is-invalid @enderror" name="surname" value="{{ $usu->surname }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="DNI" class="col-md-4 col-form-label text-md-end">{{ __('Dni') }}</label>

                        <div class="col-md-7">
                            <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ $usu->dni }}" required autocomplete="dni" autofocus>

                            @error('dni')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                        <div class="col-md-7">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usu->email }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Ense??anza') }}</label>
                        <div class="col-md-7">
                            <select name='body' class="form-control">
                                <option value="{{$usu->body}}">{{$usu->teachings->name}}</option>
                                @foreach ($ense??anzas as $ense??anza)
                                    <option value="{{$ense??anza->id}}">{{$ense??anza->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="center_code" class="col-md-4 col-form-label text-md-end">{{ __('C??digo del centro') }}</label>

                        <div class="col-md-7">
                            <input id="center_code" type="text" class="form-control @error('center_code') is-invalid @enderror" name="center_code" value="{{ $usu->center_code }}" required autocomplete="center_code" autofocus>

                            @error('center_code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Avatar') }}</label>

                        <div class="col-md-7">
                            <input id="avatar" type="file" class="form-control" name="avatar" value="" >
                        </div>
                    </div>



        </div>

        </div>


                    <div class="col-md-3" style="margin: auto">
                        @if(Auth::user()->getFirstMedia()!=null)
                            <img src="{{asset($usu->getFirstMedia()->getUrl())}}" class="img-fluid img-perf" alt="Responsive image">
                        @else
                            <img src="{{asset('storage/default/usuario.png')}}" class="img-fluid img-perf">
                        @endif
                        <div class="col-12">
                            <label for="img" style="font-weight: bold">{{ __('Imagen de perfil') }}</label>
                        </div>
                    </div>
    </div>

    <div class="row-mb-9 text-md-start perf-btn" style="margin-top: 1%;margin-bottom: 1%;margin-left: 22%">

        <button type="submit" class="btn btn-confirm">
            {{ __('Actualizar Perfil') }}
        </button>

            <a class="btn btn-secondary" href="{{route('home')}}">
                Volver Atras
            </a>

    </div>

    </form>

@endsection
