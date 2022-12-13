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
        }
    </style>
</head>
<body>
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

</body>
</html>
