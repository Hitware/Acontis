<div id="left">
    <button data-toggle="modal" data-target="#ModalAddTipoCliente" class="btn btn-acontis btn-icon-split">
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
                    @if (count($tipoclientes)>0)
                        @foreach ($tipoclientes as $tipocliente)
                            <tr>
                                <th>{{$tipocliente->nombre}}</th>
                                <th>
                                    <a data-toggle="modal" data-target="#ModalEliminarTipoCliente{{$tipocliente->id_tipocliente}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#ModalEditarTipoCliente{{$tipocliente->id_tipocliente}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </th>
                            </tr>
                            <div id="ModalEditarTipoCliente{{$tipocliente->id_tipocliente}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{url('actualizar-tipocliente',['id'=>$tipocliente->id_tipocliente])}}" method="post">
                                            @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Nombre Clasificación</label>
                                                        <input type="text" value="{{$tipocliente->nombre}}" class="form-control" id="nombre" name="nombre">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <button type="submit" class="btn btn-acontis">Actualizar</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <div id="ModalEliminarTipoCliente{{$tipocliente->id_tipocliente}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar {{$tipocliente->nombre}} del sistema?
                                            <br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <a type="button" href="{{url('eliminar-tipocliente/'.$tipocliente->id_tipocliente)}}" class="btn btn-acontis">Eliminar</a>
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
<div class="modal fade" id="ModalAddTipoCliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Clasificación</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('agregar-tipocliente')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Nombre Clasificación</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-acontis">Guardar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>

                </form>
            </div>
        </div>
    </div>
</div> 
