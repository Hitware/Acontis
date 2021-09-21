@extends('layouts.home')
@section('content')
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <a data-toggle="modal" data-target="#ModalIndicadores" href="{{url('indicadores-visitas')}}">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xm  font-weight-bold text-primary text-uppercase mb-1">
                            Visitas
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-pdf fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div id="ModalIndicadores" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{url('indicadores-visitas')}}" method="post">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <h4>Fechas</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Fecha de Inicio</label>
                                         <input type="date" name="fecha-inicio" id="fecha-inicio" required class="form-control">   
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Fecha de Fin</label>
                                        <input type="date" name="fecha-fin" id="fecha-fin" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button  style="margin-right: 10px;margin-left:10px:" type="button" data-dismiss="modal"  class="btn btn-danger">Cancelar</button>
                                <button type="submit" href="{{url('indicadores-visitas')}}" class="btn btn-acontis">Generar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection