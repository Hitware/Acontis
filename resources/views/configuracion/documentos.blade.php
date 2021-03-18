<div id="left">
    <button data-toggle="modal" data-target="#ModalAddD" class="btn btn-acontis btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Agregar</span>
    </button>
</div>
<br>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable2">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($documentos)>0)
                        @foreach ($documentos as $documento)
                            <tr>
                                <th>{{$documento->nombre}}</th>
                                <td> @if (Storage::disk('documentosacontis')->has($documento->documento))
                                    <a target="blank" href="{{url('/documentoacontis/'.$documento->documento)}}">Documento</a>    
                                @endif </td>
                            </tr>
                        @endforeach
                    @else
                    <div class="alert alert-warning" role="alert">
                        Hasta el momento no hay Documentos Cargados en el sistema
                    </div>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalAddD">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar  Documento</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('agregar-doc')}}" method="post"  enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group col">
                                <label for="">Nombre de Documento</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group col">
                                <label for="">Documento</label>
                                <input type="file" class="form-control" id="documento" name="documento">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Cargar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>

                </form>
            </div>
        </div>
    </div>
</div> 
