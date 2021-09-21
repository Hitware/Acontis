@extends('layouts.home')
@section('content')
    @foreach ($colaborador as $colaborador)
    @if (session('message'))
    <div class="alert alert-warning" role="alert">
        {{session('message')}}
    </div>  
    @endif
    <div class="container">
        <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <div class="card-body">
                <form action="{{url('update-foto-perfil',['id'=>$colaborador->id_contador])}}" method="post" enctype="multipart/form-data" >
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                
                                @if (Storage::disk('fotoperfil')->has($colaborador->url_imagen))
                                    <img src="{{url('/fotoperfil/'.$colaborador->url_imagen)}}">
                                @else
                                    <img src="{{URL::asset('img/avatar.png')}}">
                                @endif
                            </div>
                            
                            <h5 class="user-name">{{$colaborador->name}}</h5>
                            <h6 class="user-email">{{$colaborador->cargo}}</h6>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <form action="{{url('actualizar-perfil',['id'=>$colaborador->id_contador])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Información Personal</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="nombre">Nombres</label>
                                <input type="text" class="form-control" readonly value="{{$colaborador->name}}" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="nombre">Apellidos</label>
                                <input type="text" class="form-control" readonly value="{{$colaborador->lastname}}" id="apellidos" name="apellidos" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="cedula">Cédula</label>
                                <input type="text" class="form-control" readonly value="{{$colaborador->cedula}}" id="cedula" name="cedula" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="correo">Correo personal</label>
                                <input type="email" class="form-control" readonly value="{{$colaborador->correo_personal}}" id="correo" name="correo" placeholder="Correo">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fecha">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" readonly value="{{$colaborador->cumpleanos}}"  id="fecha-nacimiento" name="fecha-nacimiento" placeholder="Fecha de nacimiento">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control"  value="{{$colaborador->telefono}}" id="telefono" name="telefono" placeholder="Teléfono">
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control"  id="direccion" name="direccion" value="{{$colaborador->direccion}}" placeholder="Dirección">
                            </div>
                        </div>
                        
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fecha">Sexo</label>
                                <select disabled name="sexo" id="sexo" class="form-control">
                                    <option value="{{$colaborador->sexo}}" selected>{{$colaborador->sexo}}</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fecha">Estado Civil</label>
                                <select  name="estado_civil" id="estado_civil" class="form-control">
                                    <option value="{{$colaborador->estado_civil}}" selected>{{$colaborador->estado_civil}}</option>
                                    <option value="Soltero">Soltero</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Viudo">Viudo</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mt-3 mb-2 text-primary">Información Médica</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">Alergias</label>
                                <textarea class="form-control" id="alergias" name="alergias" placeholder="Alergias">{{$colaborador->alergias}}</textarea>    
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">Antecedentes</label>
                                <textarea class="form-control" id="antecedentes" name="antecedentes" placeholder="Antecedentes">{{$colaborador->antecedentes}}</textarea>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">RH</label>
                                <input readonly type="text" class="form-control" value="{{$colaborador->rh}}" id="rh" name="rh" placeholder="RH">                            
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">EPS</label>
                                <input type="text" class="form-control" value="{{$colaborador->eps}}" id="eps" name="eps" placeholder="EPS">                            
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">ARL</label>
                                <input type="text" class="form-control" value="{{$colaborador->arl}}" id="arl" name="arl" placeholder="ARL">                            
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">Caja de Compensación</label>
                                <input type="text" class="form-control" value="{{$colaborador->caja_compensacion}}" id="caja_compensacion" name="caja_compensacion" placeholder="Caja de Compensación">                            
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">Medicina Prepagada</label>
                                <input type="text" class="form-control" value="{{$colaborador->medicina_prepagada}}" id="medicina_prepagada" name="medicina_prepagada" placeholder="Medicina Prepagada">                            
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">Pensión</label>
                                <input type="text" class="form-control" value="{{$colaborador->pension}}" id="pension" name="pension" placeholder="Pensión">                            
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">Cesantias</label>
                                <input type="text" class="form-control" value="{{$colaborador->cesantias}}" id="cesantias" name="cesantias" placeholder="Cesantias">                            
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="contrasena">Convenios</label>
                                <input type="text" class="form-control" value="{{$colaborador->convenios}}" id="convenios" name="convenios" placeholder="Convenios">                            
                            </div>
                        </div>
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mt-3 mb-2 text-primary">Información de Emergencia</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="nombre_contacto">Nombre de Contacto</label>
                                <input type="text" class="form-control" id="nombre-contacto" name="nombre-contacto" value="{{$colaborador->nombre_contacto}}" placeholder="Nombre de Contacto">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="direccion">Teléfono de Contacto</label>
                                <input type="text" class="form-control" id="telefono-contacto" name="telefono-contacto" value="{{$colaborador->telefono_contacto}}" placeholder="Teléfono de Contacto">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="nombre_contacto">Nombre de Contacto</label>
                                <input type="text" class="form-control" id="nombre-contacto-dos" name="nombre-contacto-dos" value="{{$colaborador->nombre_contacto_dos}}" placeholder="Nombre de Contacto">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="direccion">Teléfono de Contacto</label>
                                <input type="text" class="form-control" id="telefono-contacto-dos" name="telefono-contacto-dos" value="{{$colaborador->telefono_contacto_dos}}" placeholder="Teléfono de Contacto">
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-acontis">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                
            <div class="table-responsive">
                <button data-toggle="modal" data-target="#ModalAgregar" class="btn btn-acontis">Agregar hijo</button>    
            
                <br>
                <br>
                @if ($colaborador->hijos>0)
            
                <table class="table table-striped" id="dataTable" width="90%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Sexo</th>
                            <th>Edad</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hijos as $hijo)
                            <tr>
                                <th>{{$hijo->nombres}}</th>
                                <th>{{$hijo->sexo}}</th>
                                <th>{{\Carbon\Carbon::createFromDate($hijo->fecha_nacimiento)->age}} años</th>
                                <th>
                                    <a data-toggle="modal" data-target="#ModalActualizar{{$hijo->id_hijoscolaboradores}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-info"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#ModalEliminar{{$hijo->id_hijoscolaboradores}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </th>
                            </tr>
                            <div id="ModalEliminar{{$hijo->id_hijoscolaboradores}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                                
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group col">
                                                                <label for="">¿Deseas eliminar este registro?</b></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                        </div>
                                        <div class="modal-footer">
                                            <button  style="margin-right: 10px;margin-left:10px:" type="button" data-dismiss="modal"  class="btn btn-danger">Cancelar</button>
                                            <a type="button" href="{{url('eliminar-hijo/'.$hijo->id_hijoscolaboradores)}}" class="btn btn-acontis">Eliminar</a>
                                        
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="ModalActualizar{{$hijo->id_hijoscolaboradores}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{url('actualizar-hijo',["id"=>$hijo->id_hijoscolaboradores])}}" method="post">
                                            @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Actualizar Hijo</h5>
                                        </div>
                                        <div class="modal-body">
                                            
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group col">
                                                            <label for="">Nombres</label>
                                                            <input type="text" class="form-control" value="{{$hijo->nombres}}" id="nombres" name="nombres">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group col">
                                                            <label for="">Sexo</label>
                                                            <select class="form-control" name="sexo" id="sexo" required>
                                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                                <option value="Masculino">Masculino</option>
                                                                <option value="Femenino">Femenino</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group col">
                                                            <label for="">Fecha de nacimiento</label>
                                                            <input type="date" class="form-control" value="{{$hijo->fecha_nacimiento}}" id="fecha_nacimiento" name="fecha_nacimiento">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-acontis">Guardar</button>
                                            <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                        
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                @endif
                <div class="modal fade" id="ModalAgregar">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{url('agregar-hijo',["id"=>$colaborador->id_contador])}}" method="post">
                                @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Agregar Hijo</h5>
                            </div>
                            <div class="modal-body">
                                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group col">
                                                <label for="">Nombres</label>
                                                <input type="text" class="form-control" id="nombres" name="nombres">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group col">
                                                <label for="">Sexo</label>
                                                <select class="form-control" name="sexo" id="sexo" required>
                                                    <option value="" selected disabled>--SELECCIONE--</option>
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group col">
                                                <label for="">Fecha de nacimiento</label>
                                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-acontis">Guardar</button>
                                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
            
                            </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
       
        </div>
        
        </div>
        </div>
    @endforeach
@endsection