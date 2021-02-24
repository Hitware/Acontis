<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Custom styles for this template-->
    <link href="css/estilos-reporte.css" rel="stylesheet">
    <title>Referencia Comercial</title>
</head>
<body style="background-image: url('img/hoja-reporte.png');background-size: 100% 90%;background-repeat: no-repeat;">
    <div class="container">
        @foreach ($empresa as $empresa)
        <div class="fecha">
            {{\Carbon\Carbon::setLocale('es')}}
            <b>{{\Carbon\Carbon::parse(date('Y-m-d'))->toFormattedDateString()}}</b>
        </div>
        <div class="content">
            <b> Referencia Comercial
            </b>
            <br>
            <br>
            <p style="text-align: justify">
                Por medio de la presente hago constar que, la empresa <b>{{$empresa->name_company}}</b>  con NIT <b>{{$empresa->nit_company}}</b>
 
                mantiene una cuenta comercial con nuestra empresa, desde el año 2005, periodo durante el cual ha cumplido satisfactoriamente, con sus pagos y compromisos, asumidos.
            </p>
        </div>
        <div class="footer-referencia">
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