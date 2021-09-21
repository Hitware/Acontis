@extends('layouts.home')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Lista de Colaboradores</h1>
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
<br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
           
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Cargo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($colaboradores)>0)
                            @foreach ($colaboradores as $colaborador)
                                <tr>
                                    <th>
                                        @if (Storage::disk('fotoperfil')->has($colaborador->url_imagen))
                                        <center>
                                            <img width="50%" src="{{url('/fotoperfil/'.$colaborador->url_imagen)}}">
                                        </center>
                                        @else
                                        <center>
                                            <img width="50%" src="{{URL::asset('img/avatar.png')}}">
                                        </center>
                                        @endif
                                    </th>
                                    <th>{{$colaborador->cedula}}</th>
                                    <th>{{$colaborador->name}} {{$colaborador->lastname}}</th>
                                    <th>{{$colaborador->email}}</th>
                                    <th>{{$colaborador->telefono}}</th>
                                    <th>{{$colaborador->cargo}}</th>
                                    
                                    <th>
                                        <center>
                                        <a href="{{url('perfil-colaborador/'.$colaborador->id_contador)}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-arrow-alt-circle-right"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#ModalActualizar{{$colaborador->id_contador}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        
                                        </center>
                                     </th>
                                     <th>
                                        @if (Auth::user()->id_contador!=$colaborador->id_contador && $colaborador->estado=='activos')
                                        <a data-toggle="modal" data-target="#ModalEliminar{{$colaborador->id_contador}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @else
                                        <a data-toggle="modal" data-target="#ModalReingreso{{$colaborador->id_contador}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-arrow-alt-circle-up"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#ModalVerRetiro{{$colaborador->id_contador}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @endif
                                        
                                        <a href="{{url('hoja-vida/'.$colaborador->id_contador)}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                     </th>
                                </tr>
                                <div id="ModalReingreso{{$colaborador->id_contador}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estas seguro de reingresar a <b>{{$colaborador->name}}</b> al sistema?
                                            </div>
                                            <div class="modal-footer">
                                                <button  style="margin-right: 10px;margin-left:10px:" type="button" data-dismiss="modal"  class="btn btn-danger">Cancelar</button>
                                                <a type="button" href="{{url('reingresar-colaborador/'.$colaborador->id_contador)}}" class="btn btn-acontis">Reingresar</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div id="ModalVerRetiro{{$colaborador->id_contador}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Motivo de Retiro</h3>
                                                <br>
                                                <b>{{$colaborador->motivo}}</b>
                                            </div>
                                            <div class="modal-footer">
                                                <button  style="margin-right: 10px;margin-left:10px:" type="button" data-dismiss="modal"  class="btn btn-danger">Cerrar</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div id="ModalEliminar{{$colaborador->id_contador}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{url('retirar-colaborador',['id'=>$colaborador->id_contador])}}" method="post">
                                                    
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group col">
                                                                    <label for="">Motivo de retiro de <b>{{$colaborador->name}}</b></label>
                                                                    <textarea class="form-control" required name="motivo" id="motivo" cols="30" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                            </div>
                                            <div class="modal-footer">
                                                <button  style="margin-right: 10px;margin-left:10px:" type="button" data-dismiss="modal"  class="btn btn-danger">Cancelar</button>
                                                            
                                                <button type="submit" class="btn btn-acontis">Retirar</button>
                                            
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="ModalActualizar{{$colaborador->id_contador}}" class="modal fade ">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Actualizar Empleado</h5>
                                            </div>
                                                 
                                            <div class="modal-body">
                                                <form action="{{url('actualizar-colaborador',['id'=>$colaborador->id_contador])}}" method="post">
                                                    @csrf
                                                    
                                                    <div id="smartwizard1">
                                                        <ul>
                                                            <li><a href="#step-1">Datos personales<br /><small></small></a></li>
                                                            <li><a href="#step-2">Información laboral<br /><small></small></a></li>
                                                            <li><a href="#step-3">Salud<br /><small></small></a></li>
                                                            <li><a href="#step-4">Datos de contacto<br /><small></small></a></li>
                                                        </ul>
                                                        <br>
                                                        <div>
                                                            <div id="step-1">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Nombres</label>
                                                                            <input type="text" class="form-control" value="{{$colaborador->name}}" id="nombres" name="nombres" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Apellidos</label>
                                                                            <input type="text" class="form-control"  value="{{$colaborador->lastname}}" id="apellidos" name="apellidos" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Cédula</label>
                                                                            <input type="text" class="form-control"  value="{{$colaborador->cedula}}" id="cedula" name="cedula" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">Celular</label>
                                                                            <input class="form-control" type="text"  value="{{$colaborador->telefono}}" name="telefono" id="telefono" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">Sexo</label>
                                                                            <select class="form-control" name="sexo" id="sexo" required>
                                                                                <option value="{{$colaborador->sexo}}" selected>{{$colaborador->sexo}}</option>
                                                                                <option value="Masculino">Masculino</option>
                                                                                <option value="Femenino">Femenino</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">Estado Civil</label>
                                                                            <select name="estado_civil" id="estado_civil" class="form-control" required>
                                                                                <option value="{{$colaborador->estado_civil}}" selected>{{$colaborador->estado_civil}}</option>
                                                                                <option value="Soltero">Soltero</option>
                                                                                <option value="Casado">Casado</option>
                                                                                <option value="Divorciado">Divorciado</option>
                                                                                <option value="Viudo">Viudo</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">Vivienda</label>
                                                                            <select name="estado_civil" id="estado_civil" class="form-control" required>
                                                                                <option value="{{$colaborador->vivienda}}" selected>{{$colaborador->vivienda}}</option>
                                                                                <option value="Propia">Propia</option>
                                                                                <option value="Arrendada">Arrendada</option>
                                                                                <option value="Familiar">Familiar</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="Cumpleaños">Fecha de Nacimiento</label>
                                                                        <input type="date" class="form-control" value="{{$colaborador->cumpleanos}}" name="cumpleanos" id="cumpleanos" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Correo Personal</label>
                                                                            <input class="form-control" type="email" value="{{$colaborador->correo_personal}}" name="correo-personal" id="correo-personal" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Direccion</label>
                                                                            <input type="text" class="form-control" value="{{$colaborador->direccion}}" id="direccion" name="direccion" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Hijos</label>
                                                                            <select name="hijos" id="hijos" class="form-control" required>
                                                                                <option value="{{$colaborador->hijos}}">{{$colaborador->hijos}}</option>
                                                                                <option value="0">0</option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value="7">7</option>
                                                                                <option value="8">8</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div id="step-2">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label for="RUT">RUT</label>
                                                                        <input type="file" class="form-control" name="rut" id="rut">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Correo Corporativo</label>
                                                                            <input class="form-control" type="email" value="{{$colaborador->email}}" name="correo" id="correo">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Cargo</label>
                                                                            <select class="form-control" name="cargo" id="cargo">
                                                                                <option value="{{$colaborador->cargo}}" selected>{{$colaborador->cargo}}</option>
                                                                                @foreach ($cargos as $cargo)
                                                                                    <option value="{{$cargo->nombre}}">{{$cargo->nombre}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Ubicación</label>
                                                                            <select name="ubicacion" id="ubicacion" class="form-control" required>
                                                                                <option value="{{$colaborador->ubicacion}}" selected>{{$colaborador->ubicacion}}</option>

                                                                                @include('empresas.sedes')
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group col">
                                                                            <label for="">Tipo de Contrato</label>
                                                                            <select class="form-control" name="tipo-contrato" id="tipo-contrato">
                                                                                <option value="{{$colaborador->tipo_contrato}}" selected>{{$colaborador->tipo_contrato}}</option>
                                                                                
                                                                                <option value="Laboral">Laboral</option>
                                                                                <option value="Prestación de Servicio">Prestación de Servicio</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">Salario</label>
                                                                            <input type="text" id="salario"  value="{{$colaborador->salario}}" name="salario" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">Talla Camisa</label>
                                                                            <input type="text" id="talla"  value="{{$colaborador->talla}}" name="talla" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">Talla Pantalón</label>
                                                                            <input type="text" value="{{$colaborador->talla_pantalon}}" name="talla_pantalon" id="talla_pantalon" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">Talla Zapatos</label>
                                                                            <input type="text" value="{{$colaborador->talla_zapatos}}" name="talla_zapatos" id="talla_zapatos" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="step-3" class="">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="">Alergias</label>
                                                                        <textarea name="alergias" id="alergias" cols="5" rows="2" class="form-control">{{$colaborador->alergias}}</textarea>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="">Antecedentes</label>
                                                                        <textarea class="form-control" name="antecedentes" id="antecedentes" cols="5" rows="2">{{$colaborador->antecedentes}}</textarea>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label for="">RH</label>
                                                                        <input type="text" id="rh" name="rh" value="{{$colaborador->rh}}" class="form-control">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">EPS</label>
                                                                            <input type="text" id="eps" value="{{$colaborador->eps}}" name="eps" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group col">
                                                                            <label for="">Pensión</label>
                                                                            <input type="text" id="pension" value="{{$colaborador->pension}}" name="pension" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label for="">Cesantias</label>
                                                                        <input type="text" name="cesantias" value="{{$colaborador->cesantias}}" id="cesantias" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="step-4" class="">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="">Persona de Contacto</label>
                                                                        <input type="text" id="persona-contacto" value="{{$colaborador->nombre_contacto}}" name="persona-contacto" class="form-control">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="">Telefono de Contacto</label>
                                                                        <input type="text" class="form-control" value="{{$colaborador->telefono_contacto}}" name="telefono-contacto" id="telefono-contacto" >
                                                                    </div>
                                                                    <br>
                                                                    <div class="col-md-6">
                                                                        <label for="">Persona de Contacto</label>
                                                                        <input type="text" id="persona-contacto-dos" value="{{$colaborador->persona_contacto_dos}}"  name="persona-contacto-dos" class="form-control">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="">Telefono de Contacto</label>
                                                                        <input type="text" class="form-control" value="{{$colaborador->telefono_contacto_dos}}" name="telefono-contacto-dos" id="telefono-contacto-dos" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
                <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Colaborador</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{url('/agregar-colaborador')}}" method="post">
                                @csrf
                                
                                <div id="smartwizard">
                                    <ul>
                                        <li><a href="#step-1">Datos personales<br /><small></small></a></li>
                                        <li><a href="#step-2">Información laboral<br /><small></small></a></li>
                                        <li><a href="#step-3">Salud<br /><small></small></a></li>
                                        <li><a href="#step-4">Datos de contacto<br /><small></small></a></li>
                                    </ul>
                                    <br>
                                    <div>
                                        <div id="step-1">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Nombres</label>
                                                        <input type="text" class="form-control" id="nombres" name="nombres" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Apellidos</label>
                                                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Cédula</label>
                                                        <input type="text" class="form-control" id="cedula" name="cedula" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">Celular</label>
                                                        <input class="form-control" type="text" name="telefono" id="telefono" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">Sexo</label>
                                                        <select class="form-control" name="sexo" id="sexo" required>
                                                            <option value="">--SELECCIONE--</option>
                                                            <option value="Masculino">Masculino</option>
                                                            <option value="Femenino">Femenino</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">Estado Civil</label>
                                                        <select name="estado_civil" id="estado_civil" class="form-control" required>
                                                            <option value="" selected disabled>--SELECCIONE--</option>
                                                            <option value="Soltero">Soltero</option>
                                                            <option value="Casado">Casado</option>
                                                            <option value="Divorciado">Divorciado</option>
                                                            <option value="Viudo">Viudo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">Vivienda</label>
                                                        <select name="estado_civil" id="estado_civil" class="form-control" required>
                                                            <option value="" selected disabled>--SELECCIONE--</option>
                                                            <option value="Propia">Propia</option>
                                                            <option value="Arrendada">Arrendada</option>
                                                            <option value="Familiar">Familiar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="Cumpleaños">Fecha de Nacimiento</label>
                                                    <input type="date" class="form-control" name="cumpleanos" id="cumpleanos" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Correo Personal</label>
                                                        <input class="form-control" type="email" name="correo-personal" id="correo-personal" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Direccion</label>
                                                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Hijos</label>
                                                        <select name="hijos" id="hijos" class="form-control" required>
                                                            <option value="0">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                        <div id="step-2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="RUT">RUT</label>
                                                    <input type="file" class="form-control" name="rut" id="rut">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Correo Corporativo</label>
                                                        <input class="form-control" type="email" name="correo" id="correo">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Cargo</label>
                                                        <select class="form-control" name="cargo" id="cargo">
                                                            <option value="" disabled  selected>Cargo</option>
                                                            @foreach ($cargos as $cargo)
                                                                <option value="{{$cargo->nombre}}">{{$cargo->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Ubicación</label>
                                                        <select name="ubicacion" id="ubicacion" class="form-control" required>
                                                            <option value="">--SELECCIONE--</option>
                                                            @include('empresas.sedes')
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group col">
                                                        <label for="">Tipo de Contrato</label>
                                                        <select class="form-control" name="tipo-contrato" id="tipo-contrato">
                                                            <option value="">--SELECCIONE--</option>
                                                            <option value="Laboral">Laboral</option>
                                                            <option value="Prestación de Servicio">Prestación de Servicio</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">Salario</label>
                                                        <input type="text" id="salario" name="salario" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">Talla</label>
                                                        <input type="text" id="talla" name="talla" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">Talla Pantalón</label>
                                                        <input type="text"  name="talla_pantalon" id="talla_pantalon" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">Talla Zapatos</label>
                                                        <input type="text"  name="talla_zapatos" id="talla_zapatos" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-3" class="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Alergias</label>
                                                    <textarea name="alergias" id="alergias" cols="5" rows="2" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Antecedentes</label>
                                                    <textarea class="form-control" name="antecedentes" id="antecedentes" cols="5" rows="2"></textarea>
                                                </div>
                                                <div class="col-md-">
                                                    <label for="">RH</label>
                                                    <input type="text" id="rh" name="rh" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">EPS</label>
                                                        <input type="text" id="eps" name="eps" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group col">
                                                        <label for="">Pensión</label>
                                                        <input type="text" id="pension" name="pension" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Cesantias</label>
                                                    <input type="text" name="cesantias" id="cesantias" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-4" class="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Persona de Contacto</label>
                                                    <input type="text" id="persona-contacto" name="persona-contacto" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Telefono de Contacto</label>
                                                    <input type="text" class="form-control" name="telefono-contacto" id="telefono-contacto" >
                                                </div>
                                                <br>
                                                <div class="col-md-6">
                                                    <label for="">Persona de Contacto</label>
                                                    <input type="text" id="persona-contacto-dos" name="persona-contacto-dos" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Telefono de Contacto</label>
                                                    <input type="text" class="form-control" name="telefono-contacto-dos" id="telefono-contacto-dos" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
@endsection
