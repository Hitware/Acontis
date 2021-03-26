
<br>
<div id="left">
    <button data-toggle="modal" data-target="#ModalAddSedes" class="btn btn-acontis btn-icon-split">
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
                    @if (count($sedes)>0)
                        @foreach ($sedes as $sede)
                            <tr>
                                <th>{{$sede->nombre_ciudad}}</th>
                                <th>
                                    <a data-toggle="modal" data-target="#ModalEliminar{{$sede->id_sede}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </th>
                            </tr>
                            <div id="ModalEliminar{{$sede->id_sede}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar esta sede del sistema?
                                            <br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <a type="button" href="{{url('eliminar-sede/'.$sede->id_sede    )}}" class="btn btn-acontis">Eliminar</a>
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
<div class="modal fade" id="ModalAddSedes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Sede</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('agregar-sede')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Nombre de Sede</label>
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
