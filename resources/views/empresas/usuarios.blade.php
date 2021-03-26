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
            </tr>
        </thead>
        <tbody>
            @if (count($usuarios)>0)
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->cargo}}</td>
                        <td>{{$usuario->email}}</td>
                        <td></td>
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
                    
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>