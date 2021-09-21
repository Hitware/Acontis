<div>
    <br>
    <div class="right">
      <button data-toggle="modal" data-target="#ModalAgregarPeriodo" class="btn btn-acontis btn-icon-split">
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
                <th>Periodo</th>
                @if(Auth::user()->role_id!=5)
                <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($periodos)>0)
                @foreach ($periodos as $periodo)
                    <tr>
                        <td>{{$periodo->nombre_periodo}}</td>
                        <td>
                            <a href="{{url('documentos-periodo/'.$periodo->id_periodo)}}" class="btn btn-acontis btn-circle btn-sm">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                            <a data-toggle="modal" data-target="#modalEditar{{$periodo->id_periodo}}" class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                            <a data-toggle="modal" data-target="#modalEliminar{{$periodo->id_periodo}}" class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                        </td>    
                    </tr>
                    <div id="modalEditar{{$periodo->id_periodo}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('/editar-periodo',['id'=>$periodo->id_periodo])}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group col">
                                                    <label for="">Periodo</label>
                                                    <input type="text" name="periodo" value="{{$periodo->nombre_periodo}}" id="periodo" class="form-control">
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
                    <div id="modalEliminar{{$periodo->id_periodo}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    ¿Estas seguro de eliminar el periodo <b>{{$periodo->nombre_periodo}}</b> del sistema?
                                    <br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                    <a type="button" href="{{url('eliminar-periodo/'.$periodo->id_periodo)}}" class="btn btn-acontis">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            @else
                <div class="alert alert-warning" role="alert">
                    Hasta el momento no hay documentos en el sistema
                </div> 
            @endif
        </tbody>
    </table>
</div>
<div id="ModalAgregarPeriodo" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Agregar Documento</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('/agregar-periodo',['id'=>$empresa->id_company])}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Periodo</label>
                                <input type="text" name="periodo" id="periodo" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-acontis">Crear</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
