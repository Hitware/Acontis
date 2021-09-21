@extends('layouts.home')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    {{session('message')}}
</div>
@endif
        @if($empresa[0]->servicio=="Revisoria Fiscal")
        <h4>Mis Dictamenes / Informes</h4>
        @else
            <h4>Mi Información Contable</h4>
        @endif
    <br>
    <div class="container-fluid">
        <div class="row">
            @foreach ($periodos as $periodo)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <a href="{{'documento-periodo/'.$periodo->id_periodo}}">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xm  font-weight-bold text-primary text-uppercase mb-1">
                                    {{$periodo->nombre_periodo}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-folder fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        </a>
                        <a data-toggle="modal" href="#" data-target="#ModalEnviar{{$periodo->id_periodo}}">
                            Enviar al correo
                        </a>
                        <div id="ModalEnviar{{$periodo->id_periodo}}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{url('enviar-documentos',['id'=>$periodo->id_periodo])}}" method="post">
                                   
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                        
                                    <div class="modal-body">
                                        <h5>Enviar Información contable de periodo {{$periodo->nombre_periodo}}</h5>
                                        <br>
                                            <div class="col-md-12">
                                                <div class="form-group col">
                                                    <label for="">Correo</label>
                                                    <input type="email" class="form-control" id="email" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group col">
                                                    <label for="">Mensaje</label>
                                                    <textarea class="form-control" name="mensaje" id="mensaje" cols="10" rows="3" required></textarea>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                        <button type="submit"  class="btn btn-acontis">Enviar</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection