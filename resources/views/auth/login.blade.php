<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acontis</title>
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <div class="content_logo">
        <h1>Bienvenidos a</h1>
        <img src="img/logo.png" alt="">
        <h3>¡Una herramienta pensada para TI! </h3>
        <p>Conecta con tu información contable de manera
            rápida y segura </p>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form_login">
            <div class="form_control">
                <img src="img/user.png" alt="">
                <input type="text" placeholder="Usuario" name="email" id="email">
            </div>
            <div class="form_control">
                <img src="img/key.png" alt="">
                <input type="password" placeholder="Contraseña" name="password" id="password">
            </div>

        </div>
        <div class="form_registro">
            <button type="submit" id="btn_login">INGRESAR</button>
        </div>
    </form>
</body>

</html>