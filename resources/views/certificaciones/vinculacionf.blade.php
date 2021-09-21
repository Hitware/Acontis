<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Custom styles for this template-->
    <link href="css/estilo-referencia.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Certificado Laboral</title>
</head>
<body style="background-image: url('img/hoja-reporte.png');background-size: 100% 90%;background-repeat: no-repeat;">
   <div class="container-referencia">
       @foreach ($certificado as $certificado)
        <div class="content">
            <br>
            <br>
            <center><b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">ASESORIAS CONTABLES DEL CARIBE SAS 
              <br>  NIT. 900162902 – 8                
            </b></center> 
            <br>
            <br>
            <center><b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">CERTIFICA
            </b></center> 
            <br>
            <p style="text-align: justify;font-family: Verdana, Geneva, Tahoma, sans-serif;">
                Que <b>{{$certificado->name}}{{$certificado->lastname}}</b>, identificado con cédula de ciudadanía No.{{$certificado->cedula}}, se encuentra vinculado a esta empresa 
                a través de un contrato {{$tp}}, desde el XXX (X) de XXXX de XXXX hasta la fecha, 
                desempeñándose en el cargo de {{$certificado->cargo}}.
            </p>
            <br>
            <br>
            <br>
            <p style="text-align:justify;font-family: Verdana, Geneva, Tahoma, sans-serif;">
                El presente se expide en la ciudad de Cartagena, a los {{$dia_aprobacion}} días del mes de {{$mes}} de {{$year_aprobacion}}.
            </p>
            <br>
            <br>
            <br> <br>
            <br>
            <br> <br>
            <br>
            <br>
            <br>
           
            <br>
            <div class="paco">
                <img src="{{URL::asset('img/firma-guido.png')}}" alt="">
            </div>
            <div class="paco">
                <b>DANIELA PRESUTTI FLOREZ</b>
            </div>
            <div class="paco">
                <b>No. 1.047.454.660 de Cartagena</b>
            </div>
            <div class="paco">
                <b>Directora Jurídica y Talento Humano</b>
            </div>
        </div>
        <div class="footer-referencia">
            <b>Manga Calle 28 # 27-05 Edificio Seaport Ofinicia N 901 Cartagena - Colombia</b>
            <br>
            <b>Calle 85 # 51B-159 Edificio  Quantum Tower Oficina N 805 Barranquilla - Colombia</b>
            <br>
            <a class="paco">Téfono: C/gena: (5)6606840 - B/quilla: (5) 401 0293 Fax: 693 3015 Email: servicioalcliente@acontis.co</a> 
            <br>
            <a href="" class="paco"> <img src="img/reporte/youtube.png" alt="">  <img src="img/reporte/instagram.png" alt="">  <img src="img/reporte/facebook.png" alt=""> @acontis.co <img src="img/reporte/linkedin.png" alt=""> ACONTIS</a>
        </div>
        @endforeach
</div>
</body>
</html>
