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
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($tipodocumentos)>0)
                        @foreach ($tipodocumentos as $documento)
                            <tr>
                                <th>{{$documento->nombre}}</th>
                                <th>
                                    <a data-toggle="modal" data-target="#ModalEliminar{{$documento->idconfiguracion}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </th>
                            </tr>
                            <div id="ModalEliminar{{$documento->idconfiguracion}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar {{$documento->nombre}} del sistema?
                                            <br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <a type="button" href="{{url('eliminar-tipodocumento/'.$documento->idconfiguracion)}}" class="btn btn-acontis">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <div class="alert alert-warning" role="alert">
                        Hasta el momento no hay Registros en el sistema
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
                <h5 class="modal-title">Agregar Tipo Documento</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('agregar-tipodocumento')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Tipo de Documento</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>

                </form>
            </div>
        </div>
    </div>
</div> 
