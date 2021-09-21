<div>
    <div>
      <br>
      <button data-toggle="modal" data-target="#ModalAgregar" class="btn btn-acontis btn-icon-split">
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
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Correo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($usuarios)>0)
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->cargo}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>
                            <a data-toggle="modal" data-target="#modalEditarUser{{$usuario->id_contador}}" class="btn btn-acontis btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a data-toggle="modal" data-target="#modalEliminarUser{{$usuario->id_contador}}" class="btn btn-acontis btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <div id="modalEliminarUser{{$usuario->id_contador}}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estas seguro de eliminar este usuario <b>{{$usuario->nombre}}</b> del sistema?
                                        <br>
                                        Todos los datos del sistema relacionados se eliminaran.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                        <a type="button" href="{{url('eliminar-usuarioempresa/'.$usuario->id_contador)}}" class="btn btn-acontis">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modalEditarUser{{$usuario->id_contador}}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{url('/actualizar-usuarioempresa',['id'=>$usuario->id_contador])}}" method="post">
                                       
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Nombre</label>
                                                        <input type="text" id="nombre" value="{{$usuario->name}}" name="nombre" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Cargo</label>
                                                        <input type="text" id="cargo" name="cargo" value="{{$usuario->cargo}}" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Correo</label>
                                                        <input type="text" id="correo" name="correo" value="{{$usuario->email}}" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Contraseña</label>
                                                        <input type="password" id="password" name="password" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                           
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                        <button type="submit"  class="btn btn-acontis">Actualizar</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
                
            @else
                <div class="alert alert-warning" role="alert">
                    Hasta el momento no hay usuarios en el sistema
                </div> 
            @endif
        </tbody>
    </table>
</div>
<div id="ModalAgregar" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Agregar Usuario</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('/agregar-usuarioempresa',['id'=>$empresa->id_company])}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Cargo</label>
                                <input type="text" id="cargo" name="cargo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Correo</label>
                                <input type="text" id="correo" name="correo" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    
                    <button type="submit" class="btn btn-acontis">Guardar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>