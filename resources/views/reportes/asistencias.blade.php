<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Custom styles for this template-->
    <link href="css/estilo-referencia.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('img/hoja-reporte.png');background-size: 100% 90%;background-repeat: no-repeat;">
    <h3 style="margin-top: 8%"></h3>
    <center><b style="font-family: Verdana, Geneva, Tahoma, sans-serif;text-transform: uppercase;">{{$evento[0]->nombre}} - {{$evento[0]->fecha}}</b></center>
    <br>
    <table>
        <thead>
            <tr>
                <td><b>Nombres</b></td>
                <td><b>Hora</b></td>
                <td><b>Cargo</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistentes as $asistentes)
                <tr>
                    <td class="p2">{{$asistentes->name}}</td>
                    <td class="p2">{{$asistentes->hora_asistencia}}</td>
                    <td class="p2">{{$asistentes->cargo}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>