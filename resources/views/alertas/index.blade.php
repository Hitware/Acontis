@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Centro de Alertas</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div id="container">
    <div id="left">
        <button data-toggle="modal" data-target="#ModalAgregar" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Agregar</span>
        </button>
    </div>
</div>
<br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($notificaciones)>0)
                        @foreach ($notificaciones as $notificacion)
                            <tr>
                                <th>{{$notificacion->titulo}}</th>
                                <th>@if ($notificacion->tipo==1)
                                    Colaboradores
                                @else
                                    Empresas
                                @endif</th>
                                <th>{{\FormatTime::LongTimeFilter($notificacion->created_at)}}</th>
                                <th></th>
                            </tr>
                        @endforeach
                    @else
                    <div class="alert alert-warning" role="alert">
                        Hasta el momento no hay notificaciones registradas
                    </div>
                    @endif
                </tbody>
            </table>
            <div id="ModalAgregar" class="modal fade ">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Emitir una Alerta</h5>
                        </div>
                            
                        <div class="modal-body">
                            <form action="{{url('agregar-notificacion')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group col">
                                            <label for="">¿A quienes deseas emitir la siguiente notificación?</label>
                                            <select class="form-control" name="tipo" id="tipo" required>
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1">Colaboradores</option>
                                                <option value="2">Empresas</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                        
                                    <div class="col-md-12">
                                        <div class="form-group col">
                                            <label for="">Titulo</label>
                                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col">
                                            <label for="">Notificación</label>
                                            <textarea class="form-control" id="notificacion" name="notificacion" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            <hr>
                                <br>
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection