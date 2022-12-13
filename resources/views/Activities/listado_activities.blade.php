@extends('layouts.app')

@section('content')

    @role('encargado')
    @if(Session::has('notificationE'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{Session::get('notificationE')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(Session::has('notification'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{Session::get('notification')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="row">
        <p class="h1">Listado de Actividades </p>

        <div class="cabezeraTables">

            <form method="GET" action="{{ route('crear_actividad') }}">
                @csrf
                <button type="submit" class="btn btn-success" id="create" name="create" style="margin-left: 2%; float: right" > Crear Actividad </button>
            </form>
            <form method="POST" action="{{ route('listado_actividades_pdf') }}">
                @csrf
                <button type="submit" class="btn btn-info" id="create" name="create" style="float: right" > Descargar PDF </button>
            </form>
        </div>


        <div class="filtros">
            <form method="GET" action="{{ route('listado_actividades') }}">
                @csrf
            <div class="row" style="margin-bottom: 2%">
                <label class="col-sm-3 col-xl-1 col-md-2 col-form-label text-md-end">{{ __('Cuerpos Educativos :') }}</label>
                <div class="col-sm-12 col-md-12 col-lg-2">
            <select name='teaching' class="form-control">
                <option value={{-1}}>{{"Todos"}}</option>
                @foreach ($enseñanzas as $teaching)
                    <option value="{{$teaching->id}}">{{$teaching->name}}</option>
                @endforeach
            </select>
            </div>
                <div class="row col-lg-4">
                    <label class="col-sm-8 col-xl-3 col-l-2 col-form-label text-start">{{ __('Fecha inicial :') }}</label>
                    <div class="col-lg-8">
                        <input id="date" class="form-control" type="datetime-local"   name="date_ini"  autocomplete="date" >
                    </div>
                </div>
                <div class="row col-lg-4">
                    <label class="col-sm-8 col-xl-3 col-l-2 col-form-label text-start">{{ __('Fecha final :') }}</label>
                    <div class="col-lg-8 mb-1">
                        <input id="date" class="form-control" type="datetime-local"   name="date_fin"  autocomplete="date" >
                    </div>
                </div>

                <div class="col-1 text-end btn-filtro" style="float: left;">
                <button type="submit" class="btn btn-secondary " style="float: left;">
                    {{ __('Filtrar') }}
                </button></div>
            </div>
            </form>
        </div>

        <div class="table-responsive-xxl">
            <table id="activities" class="table table-responsive-xxl">
                <thead class="listados-head">
                <tr><th>Nombre</th> <th>Descripción</th>  <th>Fecha</th> <th>Hora</th> <th>Tipo de actividad</th> <th>Lugar</th> <th>Enseñanza</th> <th>Editar</th>  <th>Eliminar</th></tr>
                </thead>
                <tbody class="listados-body">
                @foreach ($resultado as $resul)
                    <tr> <td>{{ $resul->name}}</td>
                        <td>{{ $resul->description}}</td>
                        <td>{{date("d/m/Y" , strtotime($resul->date)) }}</td>
                        <td>{{date("H:i" , strtotime($resul->date))  }}</td>
                        <td>{{ $resul->types->name}}</td>
                        <td>{{ $resul->places->name}}</td>
                        <td>{{ $resul->teachings->name}}</td>
                        <td>
                            <form method="GET" action="{{ route('editar_actividad' ,$resul->id) }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$resul->id}}">
                                <button type="submit" class="btn btn-info"> Editar </button>
                            </form>
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger borrarActividad" data-bs-toggle="modal" data-bs-target="#deleteModalActivity" value="{{$resul->id}}">
                                Eliminar
                            </button>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModalActivity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar esta actividad?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <p>¡Esta acción no se podrá revertir!</p>
                    <form method="POST" action="{{ route('borrar_actividad')}}">
                        @csrf
                        <input type="hidden" name="id" id="valueId" >
                        <button type="submit" class="btn btn-danger"> Eliminar </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
        @endrole
        @role('profesor')
        <h2>No tiene permisos para estar aquí</h2>
        <a href="/home">Volver al inicio</a>
        @endrole
    </div>

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"></script>
    <script>
        $(document).ready(function () {
            $('#activities').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.borrarActividad', function (e){
                e.preventDefault();

                var activityId = $(this).val();
                $('#valueId').val(activityId);

            });
        });
    </script>
@endsection

@endsection
