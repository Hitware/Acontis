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
            <b>Manga Calle 28 # 27-05 Edificio Seaport Ofinicia N 901 Cartagena - Colombia</b>
            <br>
            <b>Calle 85 # 51B-159 Edificio  Quantum Tower Oficina N 805 Barranquilla - Colombia</b>
            <br>
            <a class="paco">Téfono: C/gena: (5)6606840 - B/quilla: (5) 401 0293 Fax: 693 3015 Email: servicioalcliente@acontis.co</a> 
            <br>
            <br>
            <a href=""> <img src="img/reporte/youtube.png" alt="">  <img src="img/reporte/instagram.png" alt="">  <img src="img/reporte/facebook.png" alt=""> @acontis.co <img src="img/reporte/linkedin.png" alt=""> ACONTIS</a>
        </div>
        @endforeach
    </div>
</body>
</html>