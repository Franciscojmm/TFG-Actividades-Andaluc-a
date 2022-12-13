@extends('layouts.app')

@section('content')
    @role('encargado')
    @if(Session::has('notificationE'))
        <div class="alert alert-success" role="alert">
            {{Session::get('notificationE')}}
        </div>
    @elseif(Session::has('notification'))
        <div class="alert alert-primary" role="alert">
            {{Session::get('notification')}}
        </div>
    @endif

    <div>
        <h1>Listado de Usuarios borrados</h1>

        <button type="button" class="btn btn-link">
            <a style="color: blue" href="{{route('listado_usu')}}">
                Volver al listado de usuarios
            </a>
        </button>

        <div class="table table-responsive table-sm">
            <table id="users" class="table">
                <thead class="listados-head">
                <tr><th>Nombre</th> <th>Apellido</th>  <th>Email</th> <th>Dni</th> <th>Enseñanza</th> <th>Cod. Centro</th> <th>Restaurar</th><th>Eliminar</th></tr>
                </thead >
                <tbody class="listados-body">
                @foreach ($resultado as $resul)
                    <tr> <td>{{ $resul->name}}</td>
                        <td>{{ $resul->surname}}</td>
                        <td>{{ $resul->email}}</td>
                        <td>{{ $resul->dni}}</td>
                        <td>{{ $resul->teachings->name}}</td>
                        <td>{{ $resul->center_code}}</td>
                        <td>
                            <form method="POST" action="{{ route('restaura_usu') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$resul->id}}">
                                <button type="submit" class="btn btn-info"> Restaurar </button>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger destroyUsuBtn" data-bs-toggle="modal" data-bs-target="#destroyModal" value="{{$resul->id}}">
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
    <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar permanentemente a este usuario?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¡Esta acción no se podrá revertir!

                    <form method="POST" action="{{ route('destruir_usu')}}">
                        @csrf
                        <input type="hidden" name="id" id="valueId" >
                        <button style="" type="submit" class="btn btn-danger"> Destruir </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </form>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#users').DataTable(
                {
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
            $(document).on('click','.destroyUsuBtn', function (e){
                e.preventDefault();

                var usuId = $(this).val();
                $('#valueId').val(usuId);

            });
        });
    </script>
@endsection

@endsection
