@extends('layouts.app')

@section('content')

    @if(Session::has('notification'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{Session::get('notification')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="container">
        <div class="row ">
            <div class="col-12">
                @if($bActivity == "pendientes")
            <p class="h2">Actividades Pendientes</p>
            <form method="POST" action="{{ route('mis_actividades_realizadas') }}" style="float: right" >
                @csrf
                <button type="submit" class="btn btn-success" id="delete" name="delete" >Actividades Realizadas</button>
            </form>
                @else
                    <p class="h2">Actividades Realizadas</p>
                    <form method="POST" action="{{ route('mis_actividades') }}" style="float: right" >
                        @csrf
                        <button type="submit" class="btn btn-info" id="delete" name="delete" >Actividades Pendientes</button>
                    </form>
                @endif

            </div>
            @if(count($resultado) > 0 || $bActivity != "pendientes")
            @foreach($resultado as $actividad)
            <div class="col-md-3">
                <div class="card card_activities">
                    <div class="card-header card-head-activities">{{ $actividad->activities->name }}</div>
                    <div class="card-body cards-activities">
                      <label class="enunciados">Descripción</label> <p>{{ $actividad->activities->description}}</p>
                      <label class="enunciados">Fecha</label> <p>{{   date("d/m/Y" , strtotime($actividad->activities->date))     }}</p>
                      <label class="enunciados">Hora</label> <p>{{date("H:i" , strtotime($actividad->activities->date))  }}</p>
                      <label class="enunciados">Lugar</label> <p>{{ $actividad->activities->places->name}}</p>
                      <label class="enunciados">Dirección</label><p>{{ $actividad->activities->places->direction}}</p>
                        @if($bActivity == "pendientes")
                        <form method="POST" action="{{ route('anular_actividad') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$actividad->id_activity}}">
                            <button type="submit" class="btn btn-danger" id="anular" name="anular" >Anular</button>
                        </form>
                         @else
                            <form method="POST" action="{{ route('participantes_actividad') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$actividad->id_activity}}">
                                <button type="submit" class="btn btn-info" id="participantes" name="participantes" >Listar Participantes</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    @else
    <h3 class="h3" style="margin-left: 2%"> No esta inscrito en ninguna actividad <a href="{{route("actividades")}}">Ver todas las actividades.</a> </h3>
    @endif
@endsection
