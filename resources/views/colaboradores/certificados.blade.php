@extends('layouts.home')
@section('content')
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>
@endif
<br>
<div class="table-responsive">
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Colaborador</th>
                <th>Tipo Certificado</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Aprobar/Rechazar</th>
            </tr>
        </thead>
        <tbody>
            @if (count($certificaciones)>0)
            @foreach ($certificaciones as $certificacion)
                <tr>
                    <th>{{$certificacion->name}} {{$certificacion->lastname}}</th>
                    @if ($certificacion->tipo_certificado==1)
                    <th>Vinculación</th>
                    @elseif($certificacion->tipo_certificado==2)
                    <th>Vinculación con Funciones</th>
                    @else
                    <th>Vinculación para Bancos</th>
                    @endif
                    <th>{{\FormatTime::LongTimeFilter($certificacion->created_at)}}</th>
                    <th>{{$certificacion->estado}}</th>
                    <th>
                        @if ($certificacion->estado=="Solicitado")
                        <a class="btn btn-circle btn-sm btn-acontis" href="{{url('aprobar-certificado/'.$certificacion->id_certificado)}}"><i class="fas fa-check"></i></a>
                        <a class="btn btn-circle btn-sm btn-danger" href="{{url('rechazar-certificado/'.$certificacion->id_certificado)}}"><i class="fas fa-times"></i></a>
                            
                        @endif
                    </th>
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
<div id="ModalSolicitar" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{url('/solicitar-certificado',['id'=>Auth::user()->id_contador])}}" method="post">
                
            <div class="modal-header">
                <h5>Solicitar Certificado Laboral</h5>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Tipo de Certificado</label>
                                <select name="tipo" id="tipo" class="form-control" required >
                                    <option value="1">Vinculación</option>
                                    <option value="2">Vinculación con Funciones</option>
                                    <option value="3">Vinculación para Banco</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <br>
                    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-acontis">Solicitar</button>
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
            </div>  
        </form>
        </div>
    </div>
</div>
@endsection