<div id="left">
    <button data-toggle="modal" data-target="#ModalAddServicio" class="btn btn-acontis btn-icon-split">
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
                    @if (count($servicios)>0)
                        @foreach ($servicios as $servicio)
                            <tr>
                                <th>{{$servicio->nombre}}</th>
                                <th>
                                    <a data-toggle="modal" data-target="#ModalEliminarServicio{{$servicio->id_servicio}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#ModalEditarServicio{{$servicio->id_servicio}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </th>
                            </tr>
                            <div id="ModalEliminarServicio{{$servicio->id_servicio}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar {{$servicio->nombre}} del sistema?
                                            <br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <a type="button" href="{{url('eliminar-servicio/'.$servicio->id_servicio)}}" class="btn btn-acontis">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="ModalEditarServicio{{$servicio->id_servicio}}">
                                <div class="modal-dialog">
                                    <form action="{{url('actualizar-servicio',['id'=>$servicio->id_servicio])}}" method="post">
                                        @csrf
                                    
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Actualizar Servicio</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group col">
                                                            <label for="">Servicio</label>
                                                            <input type="text" value="{{$servicio->nombre}}" required class="form-control" id="nombre" name="nombre">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-acontis">Actualizar</button>
                                            <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                                        </div>
                                    </div>
                                    
                                </form>
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
<div class="modal fade" id="ModalAddServicio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Servicio</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('agregar-servicio')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Servicio</label>
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
