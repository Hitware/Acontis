@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Eventos</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div id="container">
    <div id="left">
        <button data-toggle="modal" data-target="#ModalAgregar" class="btn btn-acontis btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Agregar</span>
        </button>
    </div>
</div>
<div class="card-shadow mb-4">
    <div class="card-header py-3">
        <h6>Lista de Eventos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Clase</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Lugar</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($eventos)>0)
                        @foreach ($eventos as $evento)
                            <tr>
                                <th>{{$evento->nombre}}</th>
                                <th>{{$evento->tipo}}</th>
                                <th>{{$evento->fecha}}</th>
                                <th>{{$evento->horario}}</th>
                                <th>{{$evento->ubicacion}}</th>
                                <th>
                                    <a href="{{url('reporte-asistencia/'.$evento->id_actividad)}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a data-toggle="modal"
                                     data-target="#modalQR{{$evento->id_actividad}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-qrcode"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#ModalEditar{{$evento->id_actividad}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#modalEliminar{{$evento->id_actividad}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </th>
                            </tr>
                            <div id="modalEliminar{{$evento->id_actividad}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar este evento?
                                            <br>
                                            Todos los datos del sistema relacionados a esta evento se perderan.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <a type="button" href="{{url('eliminar-evento/'.$evento->id_actividad)}}" class="btn btn-acontis">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="ModalEditar{{$evento->id_actividad}}" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Actualizar Evento</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('/actualizar-evento',['id'=>$evento->id_actividad])}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Clase</label>
                                                            <select name="tipo" id="tipo" class="form-control" required>
                                                                <option value="">--SELECCIONE--</option>
                                                                <option value="Reunion">Reunión</option>
                                                                <option value="Actividad">Actividad</option>
                                                                <option value="Tarea">Tarea</option>
                                                                <option value="Recordatorio">Recordatorio</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Titulo</label>
                                                            <input type="text" id="nombre" name="nombre" value="{{$evento->nombre}}" class="form-control">
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Fecha</label>
                                                            <input type="date" id="fecha" name="fecha" value="{{$evento->fecha}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Hora</label>
                                                            <input type="time" id="hora" name="hora" value="{{$evento->horario}}" class="form-control">
                                                        </div>
                                                    </div>
                                                      <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Invitados</label>
                                                            <input type="text" id="invitados" name="invitados" value="{{$evento->invitados}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Ubicación</label>
                                                            <input type="text" id="ubicacion" name="ubicacion" value="{{$evento->ubicacion}}" class="form-control">
                                                        </div>
                                                    </div>
                                                     <div class="col-md-8">
                                                        <div class="form-group col">
                                                            <label for="">Descripcion</label>
                                                            <textarea name="descripcion" id="descripcion" cols="10" rows="5" class="form-control">{{$evento->descripcion}}</textarea>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-acontis">Actualizar</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modalQR{{$evento->id_actividad}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                <div class="title m-b-md">
                                                    {!!QrCode::size(300)->generate("$evento->id_actividad") !!}
                                                 </div>
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-acontis">Cerrar</button>
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
<div id="ModalAgregar" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{url('/agregar-evento')}}" method="post">
               
            <div class="modal-header">
                <h5>Agregar Evento</h5>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group col">
                                <label for="">Clase</label>
                                <select name="tipo" id="tipo" class="form-control" required>
                                    <option value="">--SELECCIONE--</option>
                                    <option value="Formación">Formación</option>
                                    <option value="Reunión">Reunión</option>
                                    <option value="Actividad">Actividad</option>
                                    <option value="Evento">Evento</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group col">
                                <label for="">Titulo</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required >
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group col">
                                <label for="">Fecha</label>
                                <input type="date" id="fecha" name="fecha" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group col">
                                <label for="">Hora</label>
                                <input type="time" id="hora" name="hora" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Invitados</label>
                                <select class="form-control invitados" name="invitados" id="invitados" required>
                                    <option value="">--SELECCIONE--</option>
                                    <option value="Colaboradores">Colaboradores</option>
                                    <option value="Empresas">Empresas</option>
                                    <option value="Todos">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" id="select-clasificacion" style="display: none">
                            <div class="form-group col">
                                <label for="">Tipo de Empresa</label>
                                <select class="form-control" name="clasificacion" id="clasificacion">
                                    <option value="">--SELECCIONE--</option>
                                    @foreach ($tipocliente as $tipocliente)
                                        <option value="{{$tipocliente->nombre}}">{{$tipocliente->nombre}}</option>
                                    @endforeach
                                    <option value="Todas">Todas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" id="select-cargo" style="display: none">
                            <div class="form-group col">
                                <label for="">Cargo</label>
                                <select class="form-control" name="cargos" id="cargos">
                                    <option value="">--SELECCIONE--</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{$cargo->nombre}}">{{$cargo->nombre}}</option>
                                    @endforeach
                                    <option value="Todos">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Ubicación</label>
                                <input type="text" id="ubicacion" name="ubicacion" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col">
                                <label for="">Descripcion</label>
                                <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <br>
                    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-acontis">Guardar</button>
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
            </div>
            </form>
        </div>
        
    </div>
</div>
<script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>
<script>
    $('.invitados').on('change', function() {
        var invitados = $(".invitados").val();
        if(invitados=="Empresas"){
           $("#select-cargo").css('display','none');
           $("#select-clasificacion").css('display','block');
        }
        else if(invitados=="Colaboradores"){
           $("#select-clasificacion").css('display','none');
           $("#select-cargo").css('display','block');
        }
        else{
           $("#select-clasificacion").css('display','none');
           $("#select-cargo").css('display','none');
        }
    });
</script>
@endsection
