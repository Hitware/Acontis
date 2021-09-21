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
            <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;" >Bienvenido <b>{{$nombre_empresa}}</b>, estamos muy felices de poder compartir con ustedes este nuevo proyecto .</p>
            <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;">A continuación compartimos el siguiente <b> código QR </b>, un registro único de identificación en nuestra base de 
            dados que nos permitirá estar mas conectados y aprovechar todas las entradas de tus servicios para así trabajar
             en la mejora continua de nuestros procesos.</p>
             <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;" >Entre algunas de sus funciones, la mas importante sera el 
                 registro de visitas y de actividades de nuestros asesores y así poder generar 
                 una mayor trazabilidad sobre la prestación de nuestros servicios.</p>
            <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;">
                Quedate con nosotros y vive la nueva experiencia <b> ACONTIS digital!</b>
            </p> 
        </div>
        <div>
            <img src="{!!$message->embedData($qr, 'QrCode.png', 'image/png')!!}">
         </div>
         <div class="row">
             <p style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size: 15px;">Este correo es generado automáticamente, por favor no responder.</p>
         </div>
    </div>
    
</body>
</html>
