@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-12">
                    <p class="h2">Participantes de la actividad  :  {{$resultado[0]->activities->name}} </p>
                    <form method="POST" action="{{ route('mis_actividades_realizadas') }}" style="float: right" >
                        @csrf
                        <button type="submit" class="btn btn-secondary mb-2" id="delete" name="delete" >Volver a mis actividades</button>
                    </form>
                <form method="POST" action="{{ route('descargar_pdf_participantes') }}" style="float: right;margin-right: 2%" >
                    @csrf
                    <input type="hidden" name="id_registro" value="{{$resultado[0]->id_activity}}">
                    <input type="hidden" name="name_activity" value="{{$resultado[0]->activities->name}}">
                    <button type="submit" class="btn btn-info" id="delete" name="delete" >Descargar PDF</button>
                </form>
            </div>
            @foreach($resultado as $actividad)
                <div class="col-lg-4 col-sm-6">
                    <div class="card" style="width: 18rem; margin: 2%">

                        @if(\App\Models\User::withTrashed()->find($actividad->id_user)->getFirstMedia() === null)
                            <img src="{{asset('storage/default/usuario.png')}}" class="card-img-top" style="max-height: 153px;">
                        @else
                            <img src="{{ \App\Models\User::withTrashed()->find($actividad->id_user)->getFirstMedia()->getUrl() }}" class="card-img-top" alt="..." style="max-height: 153px; border-radius: 0px">
                        @endif
                        <div class="card-body" style="border: 1px solid black">
                            <h5 class="card-title text-md-center">{{$actividad->users->name}}</h5>
                            <label class="enunciados">Nombre Completo</label> <p class="card-text">{{$actividad->users->name}} {{$actividad->users->surname}}</p>
                            <label class="enunciados">Centro</label> <p class="card-text">{{$actividad->users->center_code}}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
