<div >
    <div class="right">
      <br>
      @if (Auth::user()->role_id!=5)
      <button data-toggle="modal" data-target="#ModalAgregarAlerta" class="btn btn-acontis btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Agregar</span>
      </button> 
      @endif
    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Alerta</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
           @if (count($alertas)>0)
               @foreach ($alertas as $alerta)
                    @if($alerta->estado=="pendiente")
                        <tr class="bg-warning">
                    @elseif($alerta->estado=="completado")
                        <tr class="bg-success">
                    @elseif($alerta->estado=="vencido")
                        <tr class="bg-danger">
                    @endif
                       <td>{{$alerta->alerta}}</td>
                       <td>{{$alerta->fecha}}</td>
                       <td>{{$alerta->estado}}</td>
                       <td></td>
                   </tr>
               @endforeach
           @else
             <div class="alert alert-warning" role="alert">
                Hasta el momento no hay alertas creadas
                </div>
           @endif
        </tbody>
    </table>
</div>
<div id="ModalAgregarAlerta" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Agregar Alerta</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('/agregar-alerta',['id'=>$empresa->id_company])}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Clase de Alerta</label>
                                <select name="alerta" id="alerta" class="form-control" required >
                                    <option value="Vencimiento">Vencimiento</option>
                                    <option value="Impuesto">Impuesto</option>
                                    <option value="Cámara de Comercio">Cámara de Comercio</option>
                                    <option value="Retefuente">Retefuente</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col">
                                <label for="">Fecha</label>
                                <input type="date" id="fecha" name="fecha" class="form-control" required>
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