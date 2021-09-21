<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Custom styles for this template-->
    <link href="css/estilo-referencia.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Referencia Comercial</title>
</head>
<body style="background-image: url('img/hoja-reporte.png');background-size: 100% 90%;background-repeat: no-repeat;">
   <div class="container-referencia">
       @foreach ($empresa as $empresa)
        <div class="content">
            <br>
            <br>
            <center><b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">CERTIFICACIÓN
            </b></center> 
            <br>
            <p style="text-align: justify;font-family: Verdana, Geneva, Tahoma, sans-serif;">
                Certificamos qué, la empresa <b>{{$empresa->name_company}},</b> identificada con <b>NIT {{$empresa->nit_company}},</b>
                mantiene vínculo comercial con <b>ASESORIAS CONTABLE DEL CARIBE S.A.S.</b> identificada con 
                <b>NIT 900162902-8</b> desde el {{$diacontrato}} de {{$mescontrato}} del año {{$aniocontrato}}, mediante la prestación de nuestro
                 servicio @if ($empresa->servicio=="Revisoria Fiscal")
                 de    
                 @endif {{$empresa->servicio}}, durante este tiempo han demostrado como clientes
                 ser una empresa seria y cumplidora de sus obligaciones. 
            </p>
            <br>
            <br>
            <br>
            <p style="text-align:justify;font-family: Verdana, Geneva, Tahoma, sans-serif;">
                El presente se expide en la ciudad de Cartagena, a los {{date('d')}} días del mes de {{$mes}} de {{date('Y')}}.
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
            <br>
           
            <br>
            <div class="paco">
                <img src="{{URL::asset('img/firma-guido.png')}}" alt="">
            </div>
            <div class="paco">
                <b>GUIDO PRESUTTI BERRIO</b>
            </div>
            <div class="paco">
                <b>Gerente</b>
            </div>
        </div>
        <div class="footer-referencia">
            <b>Manga Calle 28 # 27-05 Edificio Seaport Ofinicia N 901 Cartagena - Colombia</b>
            <br>
            <b>Calle 85 # 50-159 Edificio  Quantum Tower Oficina N 805 Barranquilla - Colombia</b>
            <br>
            <a class="paco">Téfono: C/gena: (5)660 6840, (5)693 3015 - B/quilla: (5)401 0293 Email: servicioalcliente@acontis.co</a> 
            <br>
            <a href="" class="paco"> <img src="img/reporte/youtube.png" alt="">  <img src="img/reporte/instagram.png" alt="">  <img src="img/reporte/facebook.png" alt=""> @acontis.co <img src="img/reporte/linkedin.png" alt=""> ACONTIS</a>
        </div>
        @endforeach
</div>
</body>
</html>
