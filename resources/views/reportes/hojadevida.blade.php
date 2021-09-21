<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Custom styles for this template-->
    <link href="css/estilo-referencia.css" rel="stylesheet">
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Hoja de Vida {{$colaborador[0]->name}}</title>
</head>
<body style="background-image: url('img/formato-hoja-vida.jpg');background-size: 100% 90%;background-repeat: no-repeat;">
        <div class="row" style="margin-top:8%;">
            <div class="col-md-12">
                <div class="col-md-6" style="margin-left:13%">
                        @if (Storage::disk('fotoperfil')->has($colaborador[0]->url_imagen))
                            <img  style="margin-top: 5.8%;margin-rigth:3%" width="29%" src="{{url('/fotoperfil/'.$colaborador[0]->url_imagen)}}">
                        @else
                            <img style="margin-top: 8%" width="20%" src="{{URL::asset('img/avatar.png')}}">
                        @endif
                </div>
                <div style="margin-left: 50%;margin-top:-5%">
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">{{$colaborador[0]->name}}</b>
                        <br>
                        <a style="font-family: Verdana, Geneva, Tahoma, sans-serif;color:#189190">{{$colaborador[0]->cargo}}</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6" style="margin-top: 25%;margin-left:5%">
                    <img src="img/alfiler.png" alt=""> <a style="font-family: Verdana, Geneva, Tahoma, sans-serif;color:black">{{$colaborador[0]->direccion}}</a>
                    <br>
                    <img src="img/call.png" alt=""> <a style="font-family: Verdana, Geneva, Tahoma, sans-serif;color:black">{{$colaborador[0]->telefono}}</a>
                    <br>
                    <img src="img/email.png" alt=""> <a style="font-family: Verdana, Geneva, Tahoma, sans-serif;color:black">{{$colaborador[0]->email}}</a>
                </div>
                <div class="col-md-6" style="margin-top: -16%;margin-left:60%">
                    @foreach ($educacion as $educacion)
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Lugar de estudio: </b>{{$educacion->lugar_estudio}}
                        <br>
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Tiempo de estudio:</b> {{$educacion->tiempo_estudio}}
                        <br>
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Titulo recibido: </b>{{$educacion->titulo_obtenido}}
                    @endforeach
                </div>
                   
            </div>
            <div class="col-md-12">
                <div class="col-md-6" style="margin-top:32%;margin-left:6%">
                    @foreach ($experiencia as $experiencia)
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Lugar de trabajo:</b>  {{$experiencia->lugar}}
                        <br>
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Tiempo de trabajo:</b> {{$experiencia->tiempo_trabajo}}
                        <br>
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Jefe inmediato:</b> {{$experiencia->jefe_inmediato}}
                        <br>
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Fecha de terminación de contrato: </b> {{$experiencia->fecha_fincontrato}}
                        <br>
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Tipo de contrato: </b> {{$experiencia->tipo_contrato}}
                    @endforeach
                </div>
                <div class="col-md-6" style="margin-top:10%;margin-left:60%">
                    @foreach ($formacion as $formacion)
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Lugar de estudio: </b>{{$formacion->lugar_estudio}}
                        <br>
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Tiempo de estudio:</b> {{$formacion->tiempo_estudio}}
                        <br>
                        <b style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Titulo recibido: </b>{{$formacion->titulo_obtenido}}
                    @endforeach
                </div>  
            </div>
        </div>
        <div class="footer-referencia">
            <b style="font-size: 10px">Manga Calle 28 # 27-05 Edificio Seaport Ofinicia N 901 Cartagena - Colombia</b>
            <br>
            <b style="font-size: 10px">Calle 85 # 51B-159 Edificio  Quantum Tower Oficina N 805 Barranquilla - Colombia</b>
            <br>
            <a style="font-size: 10px" class="paco">Téfono: C/gena: (5)6606840 - B/quilla: (5) 401 0293 Fax: 693 3015 Email: servicioalcliente@acontis.co</a> 
            <br>
            <a href="" class="paco"> <img src="img/reporte/youtube.png" alt="">  <img src="img/reporte/instagram.png" alt="">  <img src="img/reporte/facebook.png" alt=""> @acontis.co <img src="img/reporte/linkedin.png" alt=""> ACONTIS</a>
        </div>
</body>
</html>
