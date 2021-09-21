@extends('layouts.home')
@section('content')
<div >
    <div class="right">
      <br>
      <button data-toggle="modal" data-target="#ModalSolicitar" class="btn btn-acontis btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Solicitar</span>
      </button> 
     
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tipo Certificado</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Descargar</th>
            </tr>
        </thead>
        <tbody>
            @if (count($certificaciones)>0)
            @foreach ($certificaciones as $certificacion)
                <tr>
                    @if ($certificacion->tipo_certificado==1)
                    <th>Vinculación</th>
                    @elseif($certificacion->tipo_certificado==2)
                    <th>Vinculación para Bancos</th>
                    @else
                    <th>Vinculación con Funciones </th>
                    @endif
                    <th>{{\FormatTime::LongTimeFilter($certificacion->created_at)}}</th>
                    <th>{{$certificacion->estado}}</th>
                    <th>
                        @if ($certificacion->estado=="Aprobado")
                           <a class="btn btn-circle btn-sm btn-acontis" href="{{url('descargar-certificado/'.$certificacion->id_certificado)}}"><i class="fas fa-download"></i></a>
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
                                    <option value="2">Vinculación para Banco</option>
                                    <option value="3">Vinculación con Funciones</option>
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