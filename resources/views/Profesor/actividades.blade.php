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

                                <p>Ya tiene una actividad a esa hora ¿Desea cancelar esa e inscribirse en la seleccionada?</p>
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
            @if(!isset($mias))
            <form method="POST" action="{{ route('actividades_cuerpos') }}" >
                @csrf
                <button type="submit" class="btn btn-success" id="show" name="show" style="float: right;margin-bottom: 1%">Mostrar solo las actividades de mi cuerpo</button>
            </form>
            @else
                <form method="GET" action="{{ route('actividades') }}">
                    @csrf
                    <button type="submit" class="btn btn-info" id="show" name="show" style="float: right;margin-bottom: 1%">Mostrar todas las actividades</button>
                </form>
            @endif

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
