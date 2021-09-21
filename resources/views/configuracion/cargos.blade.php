
<br>
<div id="left">
    <button data-toggle="modal" data-target="#ModalAddCargo" class="btn btn-acontis btn-icon-split">
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
                    <br>
                    @if (count($cargo)>0)
                        @foreach ($cargo as $cargo)
                            <tr>
                                <th>{{$cargo->nombre}}</th>
                                <th>
                                    <a data-toggle="modal" data-target="#ModalEditarCargo{{$cargo->id_cargo}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#ModalEliminarCargo{{$cargo->id_cargo}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </th>
                            </tr>
                            <div id="ModalEditarCargo{{$cargo->id_cargo}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('actualizar-cargo',['id'=>$cargo->id_cargo])}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group col">
                                                            <label for="">Nombre de Cargo</label>
                                                            <input type="text" value="{{$cargo->nombre}}" class="form-control" id="nombre" name="nombre" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group col">
                                                            <label for="">Descripcion de Cargo</label>
                                                            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3">{{$cargo->descripcion_cargo}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-acontis">Actualizar</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                            
                                            </form>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                            <div id="ModalEliminarCargo{{$cargo->id_cargo}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar este Cargo del sistema?
                                            <br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <a type="button" href="{{url('eliminar-cargo/'.$cargo->id_cargo)}}" class="btn btn-acontis">Eliminar</a>
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
<div class="modal fade" id="ModalAddCargo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Cargo</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('agregar-cargo')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Nombre de Cargo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col">
                                <label for="">Descripcion de Cargo</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3"></textarea>
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
