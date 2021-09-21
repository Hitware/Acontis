<div id="left">
    <button data-toggle="modal" data-target="#ModalAddCla" class="btn btn-acontis btn-icon-split">
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
                @if (count($clasificacion)>0)
                    @foreach ($clasificacion as $clasificacion)
                        <tr>
                            <th>{{$clasificacion->nombre}}</th>
                            <th>
                                <a data-toggle="modal" data-target="#ModalEliminarClasificacion{{$clasificacion->id_clasificacion}}" class="btn btn-acontis btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a data-toggle="modal" data-target="#ModalEditarClasificacion{{$clasificacion->id_clasificacion}}" class="btn btn-acontis btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <div class="modal fade" id="ModalEditarClasificacion{{$clasificacion->id_clasificacion}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{url('actualizar-clasificacion',['id'=>$clasificacion->id_clasificacion])}}" method="post">
                                                @csrf
                                            
                                            <div class="modal-header">
                                                <h5 class="modal-title">Actualizar </h5>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="form-group col">
                                                                <label for="">Nombre</label>
                                                                <input type="text" class="form-control" value="{{$clasificacion->nombre}}" id="nombre" name="nombre" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-acontis">Actualizar</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                                            </div>
                                        </form>

                                        </div>
                                    </div>
                                </div> 
                                <div id="ModalEliminarClasificacion{{$clasificacion->id_clasificacion}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estas seguro de eliminar este registro del sistema?
                                                <br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                                <a type="button" href="{{url('eliminar-clasificacion/'.$clasificacion->id_clasificacion)}}" class="btn btn-acontis">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    </div>
</div>
<div class="modal fade" id="ModalAddCla">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar  Tipo de Cliente</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('agregar-clasificacion')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group col">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
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
