<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Custom styles for this template-->
    <link href="css/estilos-reporte.css" rel="stylesheet">
    <title>Tabla de Empresas</title>
</head>
<body style="background-image: url('img/hoja-reporte.png');background-size: 100% 90%;background-repeat: no-repeat;">
    <div class="container">
        @foreach ($reportes as $reporte)
        <table>
            <tr>
                <td><b>Hora de Entrada: </b>  {{$reporte->hora}}</td>
                <td><b>Hora de Salida: </b> {{$reporte->hora_salida}}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="p2" ><b>NOMBRE DE CLIENTE </b> <br>  {{$reporte->codigo}}</td>
                <td class="p2"><b>NOMBRE DE ASESOR </b> <br> {{$reporte->name}}</td>
                <td class="p2"><b>FECHA DE REPORTE </b> <br> {{$reporte->fecha}}</td>
            </tr>
        </table>
        <br>
        <br>
        <b style="margin-left: 10%">REPORTE</b>
        <br>
        <table>
            <tr>
                <td class="p3">
                    {{$reporte->reporte_general}}
                </td>
            </tr>
        </table>
        <br>
        <br>
        <b style="margin-left: 10%">COMPROMISOS</b>
        <br>
        <table>
            <tr>
                <td class="p3">
                    {{$reporte->compromisos}}
                </td>
            </tr>
        </table>
        <div class="footer">
            <b>Cartagena de India, Colombia <img src="img/reporte/pointer.png" alt="">  Manga Calle 28 # 27-05 Edf. Seaport Of. 901</b>
            <br>
            <b>Barranquilla, Colombia <img src="img/reporte/pointer.png" alt=""> Calle 85 Cra 51-B. Edificio  Quantum. Oficina 805</b>
            <br>
            <a href=""> <img src="img/reporte/telephone.png" alt=""> 6606840 <img src="img/reporte/fax.png" alt=""> 693 3015 <img src="img/reporte/correo-electronico.png" alt=""> servicioalcliente@acontis.co</a> 
            <br>
            <br>
            <a href=""> <img src="img/reporte/youtube.png" alt="">  <img src="img/reporte/instagram.png" alt="">  <img src="img/reporte/facebook.png" alt=""> @acontis.co <img src="img/reporte/linkedin.png" alt=""> ACONTIS</a>
        </div>
        @endforeach
    </div>
</body>
</html>