@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Proveedores</h1>
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
        <h6>Lista de Proveedores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Proveedor</th>
                        <th>Servicio</th>
                        <th>Contacto</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Rut</th>
                        <th>Cámara Comercio</th>
                        <th>Cédula</th>
                        <th>Referencia Bancaria</th>
                        <th>Seguridad Social</th>
                        <th>SIG</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($proveedores)>0)
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <th>{{$proveedor->nombre}}</th>
                            <th>{{$proveedor->servicio}}</th>
                            <th>{{$proveedor->persona_contacto}}</th>
                            <th>{{$proveedor->correo}}</th>
                            <th>{{$proveedor->telefono_contacto}}</th>
                            <th>
                                @if (Storage::disk('rut')->has($proveedor->url_rut))
                                <a target="blank" class="btn btn-acontis btn-circle btn-sm" href="{{url('/rut/'.$proveedor->url_rut)}}"><i class="fas fa-file-download"></i></a>    
                                @endif
                            </th>
                            <th>
                                @if (Storage::disk('camaracomercio')->has($proveedor->url_rut))
                                <a target="blank" class="btn btn-acontis btn-circle btn-sm" href="{{url('/comercio/'.$proveedor->url_comercio)}}"><i class="fas fa-file-download"></i></a>    
                                @endif
                            </th>
                            <th>
                                @if (Storage::disk('cedula')->has($proveedor->url_rut))
                                <a target="blank" class="btn btn-acontis btn-circle btn-sm" href="{{url('/cedula/'.$proveedor->url_cedula)}}"><i class="fas fa-file-download"></i></a>    
                                @endif
                            </th>
                            <th>
                                @if (Storage::disk('referencia')->has($proveedor->url_referencia))
                                <a target="blank" class="btn btn-acontis btn-circle btn-sm" href="{{url('/referencia/'.$proveedor->url_referencia)}}"><i class="fas fa-file-download"></i></a>    
                                @endif
                            </th>
                            <th>
                                @if (Storage::disk('seguridad')->has($proveedor->url_seguridad_social))
                                <a target="blank" class="btn btn-acontis btn-circle btn-sm" href="{{url('/seguridad/'.$proveedor->url_seguridad_social)}}"><i class="fas fa-file-download"></i></a>    
                                @endif
                            </th>
                            <th>
                                @if (Storage::disk('sig')->has($proveedor->url_sig))
                                <a target="blank" class="btn btn-acontis btn-circle btn-sm" href="{{url('/sig/'.$proveedor->url_sig)}}"><i class="fas fa-file-download"></i></a>    
                                @endif
                            </th>
                            
                            <th>
                            @if ($proveedor->retiro!=null)
                            <a data-toggle="modal" data-target="#modalVerRetiro{{$proveedor->id_proveedor}}" class="btn btn-acontis btn-circle btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            @else
                            <a data-toggle="modal" data-target="#modalEditar{{$proveedor->id_proveedor}}" class="btn btn-acontis btn-circle btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a data-toggle="modal" data-target="#modalEliminar{{$proveedor->id_proveedor}}" class="btn btn-acontis btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a data-toggle="modal" data-target="#modalEvaluacion{{$proveedor->id_proveedor}}" class="btn btn-acontis btn-circle btn-sm">
                                <i class="fas fa-chart-line"></i>
                            </a>
                            @endif
                               
                            </th>
                            <div id="modalEvaluacion{{$proveedor->id_proveedor}}" class="modal fade">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <form action="{{url('agregar-evaluacion',['id'=>$proveedor->id_proveedor])}}" enctype="multipart/form-data" method="post">
                                            @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Agregar Evaluación</h3>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Nombre de Documento</label>
                                                        <input type="text" class="form-control" name="nombre_documento" id="nombre_documento" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group col">
                                                    <label for="">Documento</label>
                                                    <input type="file" class="form-control" name="documento" id="documento" required>
                                                </div>
                                            </div>
                                        </div>    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <button type="submit" class="btn btn-acontis">Agregar</a>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div id="modalEliminar{{$proveedor->id_proveedor}}" class="modal fade">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <form action="{{url('eliminar-proveedor',['id'=>$proveedor->id_proveedor])}}'" method="post">
                                            @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de retirar este proveedor <b>{{$proveedor->nombre}}</b> del sistema?
                                            <br>
                                            <br>
                                        <div class="col-md-12">
                                            <div class="form-group col">
                                                <label for="">Motivo de Retiro</label>
                                                <textarea name="retiro" id="retiro" cols="30" rows="2"  class="form-control"></textarea>
                                                
                                            </div>
                                        </div>    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <button type="submit" class="btn btn-acontis">Retirar</a>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div id="modalEditar{{$proveedor->id_proveedor}}" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{url('actualizar-proveedor',['id'=>$proveedor->id_proveedor])}}'" method="post">
                                            @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Nombre</label>
                                                        <input type="text" name="nombre" value="{{$proveedor->nombre}}" required id="nombre" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Nit</label>
                                                        <input type="text" value="{{$proveedor->nit}}" name="nit" id="nit"  class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Servicio</label>
                                                        <input type="text" name="servicio" value="{{$proveedor->servicio}}" id="servicio"  class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Nombre de contacto</label>
                                                        <input type="text" id="nombre-contacto" value="{{$proveedor->persona_contacto}}" required name="nombre-contacto" class="form-control"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Número de cédula</label>
                                                        <input type="text" value="{{$proveedor->cedula}}" name="cedula" id="cedula"  class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Télefono</label>
                                                        <input type="text" id="telefono" value="{{$proveedor->telefono_contacto}}" required name="telefono" class="form-control"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Correo</label>
                                                        <input type="text" id="correo" value="{{$proveedor->correo}}" name="correo" required class="form-control"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Cámara de Comercio</label>
                                                        <input type="file" id="comercio" name="comercio" class="form-control"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">RUT</label>
                                                        <input type="file" id="rut" name="rut" class="form-control"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Cédula Representante Legal</label>
                                                        <input type="file" id="cedula-file" name="cedula-file" class="form-control"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Referencia Bancaria</label>
                                                        <input type="file" id="referencia-bancaria" name="referencia-bancaria" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Seguridad Social</label>
                                                        <input type="file" id="seguridad-social" name="seguridad-social" class="form-control"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Sistema Integrado de Gestión</label>
                                                        <input type="file" id="sig" name="sig" class="form-control"  >
                                                    </div>
                                                </div>  
                                                
                                            <br>    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <button type="submit" class="btn btn-acontis">Actualizar</a>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div id="modalVerRetiro{{$proveedor->id_proveedor}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Motivo de retiro de proveedor</h3>
                                            <br>
                                            <b>{{$proveedor->retiro}}</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            

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
<div id="ModalAgregar" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{url('/agregar-proveedor')}}" enctype="multipart/form-data" method="post">
            <div class="modal-header">
                <h5>Agregar Proveedor</h5>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" required id="nombre" required class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Nit</label>
                                <input type="text" name="nit" id="nit"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Servicio</label>
                                <input type="text" name="servicio" id="servicio"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Nombre de contacto</label>
                                <input type="text" id="nombre-contacto" required name="nombre-contacto" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Número de cédula</label>
                                <input type="text" name="cedula" id="cedula"  class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Télefono</label>
                                <input type="text" id="telefono" required name="telefono" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Correo</label>
                                <input type="text" id="correo" name="correo" required class="form-control"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Cámara de Comercio</label>
                                <input type="file" id="comercio" name="comercio" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">RUT</label>
                                <input type="file" id="rut" name="rut" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Cédula Representante Legal</label>
                                <input type="file" id="cedula-file" name="cedula-file" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Referencia Bancaria</label>
                                <input type="file" id="referencia-bancaria" name="referencia-bancaria" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Seguridad Social</label>
                                <input type="file" id="seguridad-social" name="seguridad-social" class="form-control"  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group col">
                                <label for="">Sistema Integrado de Gestión</label>
                                <input type="file" id="sig" name="sig" class="form-control"  >
                            </div>
                        </div>  
                        
                    <br>
                    
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-acontis">Guardar</button>
            <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
        </div>
    </form>

    </div>
</div>
<script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>

@endsection
