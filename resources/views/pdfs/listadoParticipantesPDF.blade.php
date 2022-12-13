<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <style>
        table{
            width: 100%;
        }
        th{
            background-color: #a0aec0;
            text-align: center;
            border: 1px solid black;
        }
        td{
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>
<h3>Listado de los participantes la Actividad : {{$nombre}}</h3>
<table id="users" class="table table-responsive-xxl">
    <thead class="listados-head">
    <tr><th>Nombre</th> <th>Apellidos</th>  <th>Correo</th> <th>Codigo del centro</th></tr>
    </thead>
    <tbody class="listados-body">
    @foreach ($resultado as $resul)
        <tr> <td>{{ $resul->name}}</td>
            <td>{{ $resul->surname}}</td>
            <td>{{ $resul->email}}</td>
            <td>{{ $resul->center_code}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
