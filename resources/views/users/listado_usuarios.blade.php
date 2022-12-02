@extends('layouts.app')

@section('content')

    @if(Session::has('notificationE'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('notificationE')}}
        </div>
    @elseif(Session::has('notification'))
        <div class="alert alert-primary" role="alert">
            {{Session::get('notification')}}
        </div>
    @endif

    <div class="row">
        <h1>Listado de Usuarios</h1>

        <form method="GET" action="{{ route('/') }}">
            @csrf
            <button type="submit" class="btn btn-dark" id="create" name="create" style="margin-left: 3% ; float: right" > Listado de bloqueados </button>
        </form>


        <form method="GET" action="{{ route('/') }}">
            @csrf
            <button type="submit" class="btn btn-success" id="create" name="create" style="float: right" > Crear Usuario Admin </button>
        </form>
        <br><br>

        <div class="table-responsive-xxl">
            <table id="users" class="table table-responsive-xxl">
                <thead>
                <tr><th>Nombre</th> <th>Apellidos</th>  <th>DNI</th> <th>Email</th> <th>Codigo del centro</th> <th>Ver</th>  <th>Editar</th>  <th>Eliminar</th></tr>
                </thead>
                <tbody>
                @foreach ($resultado as $resul)
                    <tr> <td>{{ $resul->name}}</td>
                        <td>{{ $resul->surname}}</td>
                        <td>{{ $resul->dni}}</td>
                        <td>{{ $resul->email}}</td>
                        <td>{{ $resul->center_code}}</td>
                        <td>
                            <form method="POST" action="{{ route('/') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$resul->id}}">
                                <button type="submit" class="btn btn-success"> Ver </button>
                            </form>
                        </td>

                        <td>
                            <form method="POST" action="{{ route('/' ,$resul->id) }}">
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
                    <form method="POST" action="{{ route('/')}}">
                        @csrf
                        <input type="hidden" name="id" id="valueId" >
                        <button type="submit" class="btn btn-danger"> Eliminar </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });
    </script>
    <script>
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
