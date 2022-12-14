@extends('layouts.app')

@section('content')

    @role('encargado')
    @if(Session::has('notificationE'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{Session::get('notificationE')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(Session::has('notification'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{Session::get('notification')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <p class="h1">Listado de Usuarios</p>

        <div class="cabezeraTables">


            <div class="auste">
            <form method="GET" action="{{ route('crear_usuario') }}">
                @csrf
                <button type="submit" class="btn btn-success" id="create" name="create" style="margin-left: 2%; float: right" > Crear Usuario </button>
            </form>

            <form method="POST" action="{{ route('descargar_pdf') }}">
                @csrf
                @if(isset($actividadSeleccionada))
                <input type="hidden" name="selecc" value="{{intval($actividadSeleccionada)}}">
                @endif
                <button type="submit" class="btn btn-info" id="create" name="create" style="float: right" > Descargar PDF </button>
            </form>

            <form method="GET" action="{{ route('listado_usus_eliminados') }}">
                @csrf
                <button type="submit" class="btn btn-dark" id="create" name="create" style="margin-right: 2%; float: right; " > Listado de bloqueados </button>
            </form>
            </div>
        </div>


        <div class="filtros" style="margin-bottom: 1%">

            <form method="GET" action="{{ route('listado_usu') }}">
                @csrf
                <div class="row">
                    <label class="col-sm-3 col-lg-1 col-form-label text-md-start">{{ __('Cuerpo Enseñanza :') }}</label>
                    <div class="col-md-2">
                        <select name='actividadSeleccionada' class="form-control">
                            <option value={{-1}}>{{"Todas"}}</option>
                            @if(isset($actividadSeleccionada))
                            @foreach ($actividades as $actividad)
                                @if($actividadSeleccionada == $actividad->id)
                                <option value="{{$actividad->id}}" selected>{{$actividad->name}}</option>
                                    @else
                                        <option value="{{$actividad->id}}">{{$actividad->name}}</option>
                                    @endif
                            @endforeach
                            @else
                                @foreach ($actividades as $actividad)
                                    <option value="{{$actividad->id}}">{{$actividad->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-2 text-end">
                        <button type="submit" class="btn btn-secondary">
                            {{ __('Filtrar') }}
                        </button></div>
                </div>
            </form>
        </div>



        <div class="table-responsive-xxl">
            <table id="users" class="table table-responsive-xxl">
                <thead class="listados-head">
                <tr><th>Nombre</th> <th>Apellidos</th>  <th>DNI</th> <th>Email</th> <th>Enseñanza</th> <th>Cod. Centro</th> <th>Rol</th> <th>Editar</th> <th>Eliminar</th></tr>
                </thead>
                <tbody class="listados-body">
                @foreach ($resultado as $resul)
                    <tr> <td>{{ $resul->name}}</td>
                        <td>{{ $resul->surname}}</td>
                        <td>{{ $resul->dni}}</td>
                        <td>{{ $resul->email}}</td>
                        <td>{{ $resul->teachings->name}}</td>
                        <td>{{ $resul->center_code}}</td>
                        <td>{{ $resul->getRoleNames()[0]}}</td>
                        <td>
                            <form method="GET" action="{{ route('editar_usu' ,$resul->id) }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$resul->id}}">
                                <button type="submit" class="btn btn-info"> Editar </button>
                            </form>
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger bloquearUsuBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" value="{{$resul->id}}">
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
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere bloquear este usuario?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form method="POST" action="{{ route('eliminar_usu')}}">
                        @csrf
                        <input type="hidden" name="id" id="valueId" >
                        <button type="submit" class="btn btn-danger"> Eliminar </button>
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
            $('#users').DataTable({
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
        console.log({{Auth::id()}});

        $(document).ready(function () {

            $(document).on('click','.bloquearUsuBtn', function (e){
                e.preventDefault();

                var usuId = $(this).val();
                $('#valueId').val(usuId);

            });
        });
    </script>
@endsection

@endsection
