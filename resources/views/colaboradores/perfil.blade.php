@extends('layouts.home')
@section('content')
@foreach ($colaborador as $colaborador)
    <h1 class="h3 mb-2 text-gray-800">{{$colaborador->name}}</h1>   
    @if (session('message'))
    <div class="alert alert-warning" role="alert">
        {{session('message')}}
    </div>  
    @endif
    <div class="right">
        <br>
        <button data-toggle="modal" data-target="#ModalAgregar" class="btn btn-acontis btn-icon-split">
          <span class="icon text-white-50">
              <i class="fas fa-plus"></i>
          </span>
          <span class="text">Agregar</span>
        </button>
      </div>
      <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>Documentos</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Descargar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($titulos)>0)
                            @foreach ($titulos as $titulo)
                                <tr>
                                    <th>{{$titulo->nombre}}</th>
                                    <th>
                                        @if (Storage::disk('titulos')->has($titulo->ubicacion))
                                            <a target="blank" href="{{url('/titulo/'.$titulo->ubicacion)}}">Titulo</a> 
                                        @endif
                                    </th>
                                    <th></th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="ModalAgregar" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Agregar Documento</h5>
                </div>
                <div class="modal-body">
                    <form action="{{url('/agregar-titulo',['id'=>$colaborador->id_contador])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group col">
                                    <label for="">Tipo Documento</label>
                                    <select name="tipo-documento" id="tipo-documento" class="form-control" required >
                                        @foreach ($tipo_documentos as $tipodocumento)
                                            <option value="{{$tipodocumento->idconfiguracion}}">{{$tipodocumento->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col">
                                    <label for="">Documento</label>
                                    <input type="file" id="documento" name="documento" class="form-control" required>
                                </div>
                            </div>  
                            
                        </div>
                        <br>
                        
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach    
@endsection