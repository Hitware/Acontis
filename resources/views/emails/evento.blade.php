<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <img height="10%" width="100%" src="https://crm.acontis.co/img/cabezote.jpg" alt="">
        <div class="row">
            <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;" >Hola, <b>{{$nombre_empresa}}</b></p>
            <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;">Hemos organizado un evento para ti.</p>
            <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;" >{{$nombre_evento}}</p>
            <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;">{{$descripcion_evento}}</p> 
        </div>
        
         <div class="row">
             <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;">Este correo es generado automáticamente, por favor no responder.</p>
         </div>
    </div>
    
</body>
</html>
