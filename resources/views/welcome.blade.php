@extends('layouts.app')

@section('content')

    <div class="row">
        <p class="h1">Listado de Actividades</p>

        <div class="table-responsive-xxl">
            <table id="users" class="table table-responsive-xxl">
                <thead class="listados-head">
                <tr><th>Nombre</th> <th>Descripción</th>  <th>Fecha</th> <th>Hora</th> <th>Tipo de actividad</th> <th>Lugar</th> <th>Enseñanza</th></tr>
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

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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
        $(document).ready(function () {
            $(document).on('click','.borrarActividad', function (e){
                e.preventDefault();

                var usuId = $(this).val();
                $('#valueId').val(usuId);

            });
        });
    </script>
@endsection

@endsection
