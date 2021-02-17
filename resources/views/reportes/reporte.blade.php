<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/scrolling-nav.css')}}" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="{{URL::asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">
    <link href="{{URL::asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <link href="{{URL::asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css')}}"/>
</head>
<body>

    
      <header class="color-header text-white">

        <div class="container text-center">
        <img width="35%" src="{{URL::asset('img/acontis_blanco.svg')}}">
            <br>
          <h2 style="margin-top: 3%">Retroalimentación de Visitas</h2>
        </div>
      </header>
      <br>
      <section id="about">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
                <center>
                    <form action="{{url('actualizar-reporte',['id'=>request()->route('id')])}}" method="post">
                        <div class="col-md-10">
                            <div class="form-group col">
                                <label for="">Comentarios</label>
                                <textarea required class="form-control" name="comentarios" id="comentarios" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group col">
                                <label for="">¿Apruebas el reporte recibido por parte de tu asesor?</label>
                                <select class="form-control" name="estado" id="estado" required>
                                    <option value="">--SELECCIONE--</option>
                                    <option value="Aprobado">Si</option>
                                    <option value="No Aprobado">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                        <button type="submit" class="btn btn-success">Enviar</button>
        
                            </div>
                        </div>
                      </form>
                </center>
                
            </div>
          </div>
        </div>
      </section>
      <!-- Footer -->    
</body>
</html>