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
        <img height="10%" width="100%" src="img/cabezote.jpg" alt="">
        <div class="row">
            <p>Hola {{$nombre_empresa}}, esperamos que te encuentres muy bien.</p>
            <p>El código QR que se muestra a continuación es para el registro de visitas que eventualmente nuestros
                asesores harán a su establecimiento, es de vital importancia que sea compartido con las personas que atenderán a tu asesor ya que con este podremos generar un reporte de cada visita que hagamos. 
            </p>
        </div>
        <div>
            <img src="{!!$message->embedData($qr, 'QrCode.png', 'image/png')!!}">
         </div>
         <div class="row">
             <p>Este correo es generado automaticamente, por favor no responder.</p>
         </div>
    </div>
    
</body>
</html>