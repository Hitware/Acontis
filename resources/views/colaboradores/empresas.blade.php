@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Mis Empresas</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6>Lista de Empresas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Nit</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Rep. Legal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($empresas)>0)
                        @foreach ($empresas as $empresa)
                            <tr>
                                <th>{{$empresa->name_company}}</th>
                                <th>{{$empresa->nit_company}}</th>
                                <th>{{$empresa->email_company}}</th>
                                <th>{{$empresa->telephone_company}}</th>
                                <th>{{$empresa->representante_legal}}</th>
                                <th>
                                    <a href="{{url('perfil-empresa/'.$empresa->id_company)}}" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-arrow-alt-circle-right"></i>
                                    </a>
                                    <button onclick="mostrarReporte({{$empresa->id_company}})" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a data-toggle="modal"
                                     data-target="#modalQR{{$empresa->id_company}}" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-qrcode"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#modalEnviar{{$empresa->id_company}}" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-share-square"></i>
                                    </a>
                                </th>
                            </tr>
                            <div id="modalQR{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                <div class="title m-b-md">
                                                    {!!QrCode::size(300)->generate($empresa->name_company) !!}
                                                 </div>
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modalEnviar{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Para confirmar el envio del QR a la empresa {{$empresa->name_company}} porfavor da clic en Enviar
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cerrar</button>
                                            <a type="button" href="{{url('enviar-qr/'.$empresa->id_company)}}" class="btn btn-success">Enviar</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach
                    @else
                        <div class="alert alert-warning" role="alert">
                            Hasta el momento no tienes empresas asignadas
                        </div> 
                    @endif
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<div id="reportesEmpresa" class="modal fade">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="reportEmpresa">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#visitas" role="tab" aria-controls="visitas" aria-selected="true">Visitas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#actividades" role="tab" aria-controls="actividades" aria-selected="false">Actividades</a>
                    </li>
                    
                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="visitas" role="tabpanel" aria-labelledby="home-tab">
                    <br>
                    <div class="container" id="visitaslist">

                    </div>
                </div>
                <div class="tab-pane fade" id="actividades" role="tabpanel" aria-labelledby="profile-tab">
                    <br>
                    <div id="actividadeslist" class="container">

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="mostrar-reportes" method="post" id="form">
    <input type="hidden" name="idempresa" id="idempresa">
    @csrf
</form>
<form action="generar-pdf" method="get" id="form1">
    @csrf
</form>
<script src="{{URL::asset('js/mostrar-reporte.js')}}"></script>
<script src="{{URL::asset('js/descargar-reporte.js')}}"></script>
@endsection