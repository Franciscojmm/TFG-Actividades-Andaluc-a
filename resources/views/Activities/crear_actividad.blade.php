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
                    <div class="card-header card_header_login_register">{{ __('Crear Actividad') }}</div>

                    <div class="card-body ">
                        <form method="POST" action="{{ route('guardar_actividad') }}" class="mform1" id="mform1" >
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
                                <label for="name" class="col-md-4 col-form-label text-md-center">{{ __('Descripción') }}</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  autocomplete="name" autofocus>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="date" class="col-md-4 col-form-label text-md-center">{{ __('Fecha') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Tipo de actividad') }}</label>

                                <div class="col-md-6">
                                    <select name='type' class="form-control">
                                        @foreach ($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Lugar') }}</label>

                                <div class="col-md-6">
                                    <select name='place' class="form-control">
                                        @foreach ($places as $place)
                                            <option value="{{$place->id}}">{{$place->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-center">{{ __('Enseñanza') }}</label>

                                <div class="col-md-6">
                                    <select name='teaching' class="form-control">
                                        @foreach ($teachings as $teaching)
                                            <option value="{{$teaching->id}}">{{$teaching->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="id_submitbutton" type="submit" class="btn" style="background-color: #22A39F!important;color: white">
                                        {{ __('Crear Actividad') }}
                                    </button>

                                        <a class="btn btn-secondary" href="{{route('listado_actividades')}}">
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
@section('js')
    <!-- <script src={{asset('js/validar.js')}}></script> -->
@endsection

@endsection
