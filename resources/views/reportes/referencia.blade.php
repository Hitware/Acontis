<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Custom styles for this template-->
    <link href="css/estilos-referencia.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Referencia Comercial</title>
</head>
<body>
    <div style="width: 100%">
            <div>
                <img width="100%" src="{{URL::asset('img/encabezado-reporte.png')}}" alt="">
            </div>
    </div>
   <div class="container-referencia">
        <div class="content">
            <br>
            <center><b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">CERTIFICACIÓN
            </b></center> 
            <br>
            <br>
            <p style="text-align: justify;font-family: Verdana, Geneva, Tahoma, sans-serif;">
                Certificamos qué, la empresa <b>{{$empresa->name_company}},</b> identificada con <b>NIT {{$empresa->nit_company}},</b>
                mantiene vínculo comercial con <b>ASESORIAS CONTABLE DEL CARIBE S.A.S.</b> identificada con 
                <b>NIT 900162902-8</b>  desde el --- de ----,mediante la prestación de nuestros servicios ---------, durante este tiempo han demostrado como clientes
                 ser una empresa seria y cumplidora de sus obligaciones. 
            </p>
            <p style="text-align:justify;font-family: Verdana, Geneva, Tahoma, sans-serif;">
                El presente se expide en la ciudad de Cartagena, a los {{date('d')}} días del mes de {{$mes}} de {{date('Y')}}.
            </p>
            <br>
            <div class="paco">
                <img src="{{URL::asset('img/firma-guido.png')}}" alt="">
            </div>
            <div class="paco">
                <b>GUIDO PRESUTTI BERRIO</b>
            </div>
            <div class="paco">
                <b>Gerente General</b>
            </div>
        </div>
</div>
   
</body>
</html>
