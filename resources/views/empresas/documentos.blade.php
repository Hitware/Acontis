<div>
    <div>
      <br>
    
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Fecha</th>
                @if(Auth::user()->role_id!=5)
                <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($scanner)>0)
                @foreach ($scanner as $documento)
                    <tr>
                        <td>{{$documento->nombre}}</td>
                        <td> <a href="{{$documento->ruta_imagen}}" target="_blank" ><i class="fas fa-download"></i></a></td>
                        <td>{{$documento->fecha}}</td>
                        @if(Auth::user()->role_id!=5)
                        <td><a data-toggle="modal" data-target="#ModalEditarDoc{{$documento->id_documento}}" class="btn btn-acontis btn-circle btn-sm">
                            <i class="fas fa-pencil-alt"></i></td>
                        @endif
                    </tr>
                    <div id="ModalEditarDoc{{$documento->id_documento}}" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Agregar Documento</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('/modificar-documento',['id'=>$documento->id_documento])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group col">
                                                    <label for="">Documento</label>
                                                    <input type="file" id="documentou" name="documentou" class="form-control" required>
                                                </div>
                                            </div> 
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-acontis">Cargar Documento</button>
                                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <form action="{{url('/agregar-documento',['id'=>$empresa->id_company])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Clase documento</label>
                                <select name="clase-documento" id="clase-documento" class="form-control" required >
                                    <option value="clase1">Clase 1</option>
                                    <option value="clase2">Clase 2</option>
                                    <option value="clase3">Clase 3</option>
                                    <option value="clase4">Clase 4</option>
                                    <option value="clase5">Clase 5</option>
                                </select>
                            </div>
                        </div>
                        @if (Auth::user()->role_id!=5)
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Documento</label>
                                <input type="file" id="documento" name="documento" class="form-control" required>
                            </div>
                        </div> 
                        @endif
                    </div>
                    <br>
                    <button type="submit" class="btn btn-acontis">Solicitar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>