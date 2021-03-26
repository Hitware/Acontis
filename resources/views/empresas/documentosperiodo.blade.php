@extends('layouts.home')
@section('content')
<div class="container">
    <div class="right">
      <br>
      <button data-toggle="modal" data-target="#ModalAgregarDoc" class="btn btn-acontis btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Agregar</span>
        
      </button>
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th></th>
                <th>Documento</th>
                
            </tr>
        </thead>
        <tbody>
           @if (count($documentos)>0)
               @foreach ($documentos as $documento)
                   <tr>
                       <td>{{$documento->nombre_documento}}</td>
                       <td> @if (Storage::disk('documentosperiodo')->has($documento->url_documento))
                        <a target="blank" href="{{url('/documentoperiodo/'.$documento->url_documento)}}">Documento</a>    
                    @endif </td>
                   </tr>
               @endforeach
           @else
           <div class="alert alert-warning" role="alert">
            Hasta el momento no hay documentos en el sistema
            </div> 
           @endif
        </tbody>
    </table>
</div>
<div id="ModalAgregarDoc" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Agregar Documento</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('/agregar-documentoperiodo',['id'=>$periodo])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Nombre Documento</label>
                                <input type="text" class="form-control" name="nombredocumento" id="nombredocumento">
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
                    <button type="submit" class="btn btn-success">Cargar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection