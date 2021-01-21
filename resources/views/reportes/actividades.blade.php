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
<body>
    <div class="container">
        @foreach ($reportes as $reporte)
        <div class="content row ">
            <div class="circulo">
                <div class="c-1" style="margin-top: 2%">
                  <img src="img/logo_reporte.png" width="95%" alt="">
                </div>
                <div class="c-2" >
                    
                        
                  
                    <h5 class="title" style="color: black"><b>REPORTE DE ACTIVIDADES</b></h5>
                    <div class="c-3" style="background-color:white">
                        <table>
                            <tr>
                                <td class="bor-b" > <b> Código: </b>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="bor-b"><b>Tipo de Reporte: </b>
                                    {{$reporte->tipo_reporte}}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Fecha: </b>
                                     
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="content-2">

            <div class="info-2">
                <table>
                    <tr>
                        <td> <b> Nombre del Asesor</b>
                            {{$reporte->name}}
                        </td>
                    </tr>
                    <tr>
                        <td><b>Fecha de Reporte: </b>
                            {{$reporte->fecha}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <br>
                        <b>Hora de Entrada: </b>
                           {{$reporte->hora}}
                        </td>
                    </tr>
                    <tr>
                        <td><b>Hora de Salida: </b>
                            {{$reporte->hora_salida}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="circulo circulo-2">
            <div class="info-3">
                    <b style="font-size:15px"> Reporte </b>
                    <a style="font-size:13px">{{$reporte->reporte_general}}</a>
                <br>
                <b  style="font-size:15px">Compromisos</b>
                <a style="font-size:13px">{{$reporte->compromisos}}</a>
               <br>

                
            </div>

        </div> 
        @endforeach
    </div>
</body>
</html>