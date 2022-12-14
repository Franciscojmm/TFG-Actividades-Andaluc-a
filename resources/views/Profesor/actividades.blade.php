@extends('layouts.app')

@section('content')


    @if(Session::has('actividad_actual'))

            <dialog class="dialogo-ejemplo animate__animated animate__flipInX" id="modalHtml" style="z-index: 3;">
                <div class="row" style="margin-bottom: 2%">
                    <div class="col-12">
                        <div id="myModal">
                            <form method="POST" action="{{ route('procesar_cambios') }}" style="float: right" >
                                @csrf
                                <input type="hidden" name="actividad_actual" value="{{Session::get('actividad_actual')[0]}}">
                                <input type="hidden" name="actividad_cambio" value="{{Session::get('actividad_actual')[1]}}">

                                <p>Usted ya está inscrito en la actividad : {{\App\Models\Activity::find(Session::get('actividad_actual')[0])->name}} en esa fecha.</p>
                                <p>¿Desea cancelar la actividad en la que está inscrito e inscribirse en la siguiente actividad : {{\App\Models\Activity::find(Session::get('actividad_actual')[1])->name}} ?
                                </p>
                                <button type="submit" class="btn btn-success" id="show" name="show" >Procesar cambio</button>
                                <a id="cancelar-btn" class="btn btn-danger" onclick="hideThisDialog()">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </dialog>
    @endif


    <div class="container">
        <div class="row ">
            <p class="h2">Todas las Actividades</p>
            <form method="POST" action="{{ route('filtrarTodasActividades') }}" >
                @csrf
                <div class="row mt-1 mb-3">
                    @if(!isset($mias))
                    <div class="mb-3 mt-1" style="display: flex; justify-content: center">
                        <div class="form-check">

                            <input class="form-check-input" type="radio" name="tipo_activity" id="flexRadioDefault1" checked value="todas">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Todas las Actividades
                            </label>
                        </div>
                        <div class="form-check" style="margin-left: 5%">
                            <input class="form-check-input" type="radio" name="tipo_activity" id="flexRadioDefault2"  value="mias">
                            <label class="form-check-label" for="flexRadioDefault2">
                                 {{Auth::user()->teachings->name}} (Mi cuerpo)
                            </label>
                        </div>
                    </div>
                    @else
                    @if($mias == "todas" )
                            <div class="mb-3 mt-1" style="display: flex; justify-content: center">
                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="tipo_activity" id="flexRadioDefault1" checked value="todas">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Todas las Actividades
                                    </label>
                                </div>
                                <div class="form-check" style="margin-left: 5%">
                                    <input class="form-check-input" type="radio" name="tipo_activity" id="flexRadioDefault2"  value="mias">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{Auth::user()->teachings->name}} (Mi cuerpo)
                                    </label>
                                </div>
                            </div>
                        @else
                            <div class="mb-3 mt-1" style="display: flex; justify-content: center">
                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="tipo_activity" id="flexRadioDefault1" value="todas">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Todas las Actividades
                                    </label>
                                </div>
                                <div class="form-check" style="margin-left: 5%">
                                    <input class="form-check-input" type="radio" name="tipo_activity" id="flexRadioDefault2" checked value="mias">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        {{Auth::user()->teachings->name}} (Mi cuerpo)
                                    </label>
                                </div>
                            </div>
                        @endif
                    @endif
                <div class="row col-lg-5">
                    <label class="col-sm-8 col-xl-3 col-l-2 col-form-label text-start" >{{ __('Fecha inicial :') }}</label>
                    <div class="col-lg-8">
                        @if(isset($opciones['di']))
                            <input id="date" class="form-control" type="datetime-local"  value="{{$opciones['di']}}"  name="date_ini"  autocomplete="date" >
                        @else
                            <input id="date" class="form-control" type="datetime-local"   name="date_ini"  autocomplete="date" >
                        @endif
                    </div>
                </div>
                <div class="row col-lg-5">
                    <label class="col-sm-8 col-xl-3 col-l-2 col-form-label text-start">{{ __('Fecha final :') }}</label>
                    <div class="col-lg-8 mb-1">
                        @if(isset($opciones['df']))
                            <input id="date2" class="form-control" type="datetime-local"   value="{{$opciones['df']}}"  name="date_fin"  autocomplete="date" >
                        @else
                            <input id="date2" class="form-control" type="datetime-local"  name="date_fin"  autocomplete="date" >
                        @endif
                    </div>
                </div>
                    <div class="col-lg-1 ">
                    <button type="submit" class="btn btn-success" id="show" name="show" style="float: right;margin-bottom: 1%">Filtrar</button>
                    </div>
                </div>
            </form>


            @foreach($resultado as $actividad)
                <div class="col-xl-3 col-sm-6">
                    <div class="card card_activities">
                        <div class="card-header card-head-activities">{{ $actividad->name }}</div>
                        <div class="card-body cards-activities">
                            <label class="enunciados">Descripción</label> <p>{{ $actividad->description}}</p>
                            <label class="enunciados">Fecha</label> <p>{{   date("d/m/Y" , strtotime($actividad->date))     }}</p>
                            <label class="enunciados">Hora</label> <p>{{date("H:i" , strtotime($actividad->date))  }}</p>
                            <label class="enunciados">Lugar</label> <p>{{ $actividad->places->name}}</p>
                            <label class="enunciados">Dirección</label><p>{{ $actividad->places->direction}}</p>
                            @if($actividad->teaching == Auth::user()->body)

                                @if(count(\App\Models\User_activities::where('id_user','=',Auth::id())->where('id_activity','=',$actividad->id)->get()) > 0)
                                <form method="POST" action="{{ route('anular_actividad') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$actividad->id}}">
                                    <button type="submit" class="btn btn-danger" id="anular" name="anular" >Anular</button>
                                </form>
                                    @else
                                    <form method="POST" action="{{ route('inscribir_actividad') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$actividad->id}}">
                                        <button type="submit" class="btn btn-info" id="iscribir" name="inscribirme" >Inscribirme</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    @section('js')
        <script>
            console.log("hola");
            var myModal = document.getElementById('modalHtml');
            if(myModal){
            myModal.showModal();
            myModal.addEventListener('click', function(){
                myModal.close();
            });
            }
            //*document.getElementById('cancelar-btn').addEventListener('click', function(){
  //              myModal.close();
//            });
//
            function hideThisDialog() {
                document.getElementById('modalHtml').close();
            }


            function cerrarModal(){
                myModal.close();
            }


        </script>
    @endsection
@endsection
