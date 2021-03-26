@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Lista de Reportes</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6></h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#visitas" role="tab" aria-controls="home" aria-selected="true">Visitas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#actividades" role="tab" aria-controls="profile" aria-selected="false">Actividades</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="visitas" role="tabpanel" aria-labelledby="home-tab">
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Nombre Asesor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($visitas)>0)
                                @foreach ($visitas as $visita)
                                    <tr>
                                        <td>{{$visita->fecha}}</td>
                                        <td>{{$visita->hora}}</td>
                                        <td>{{$visita->name}}</td>
                                        <td><a onclick="generarPdf('{{$visita->id_reporte}}')" class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-file-pdf"></i></a></td>
                                    </tr>
                                @endforeach
                            @else
                            <div class="alert alert-warning" role="alert">
                                Hasta el momento no hay Registros en el sistema
                            </div> 
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="actividades" role="tabpanel" aria-labelledby="profile-tab">
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Nombre Asesor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($reportes)>0)
                                @foreach ($reportes as $reporte)
                                    <tr>
                                        <td>{{$reporte->fecha}}</td>
                                        <td>{{$reporte->hora}}</td>
                                        <td>{{$reporte->name}}</td>
                                        <td><a onclick="generarPdf('{{$reporte->id_reporte}}')" class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-file-pdf"></i></a></td>
                                    </tr>
                                @endforeach
                            @else
                            <div class="alert alert-warning" role="alert">
                                Hasta el momento no hay Registros en el sistema
                            </div> 
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
          </div> 
    </div>
</div>
<script src="{{URL::asset('js/descargar-reporte.js')}}"></script>
@endsection