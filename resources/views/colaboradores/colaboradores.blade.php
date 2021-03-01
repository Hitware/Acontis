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
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Cargo</th>
                            <th>Salario</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($colaboradores)>0)
                            @foreach ($colaboradores as $colaborador)
                                <tr>
                                    <th>{{$colaborador->cedula}}</th>
                                    <th>{{$colaborador->name}}</th>
                                    <th>{{$colaborador->email}}</th>
                                    <th>{{$colaborador->telefono}}</th>
                                    <th>{{$colaborador->cargo}}</th>
                                    <th>{{$colaborador->salario}}</th>
                                    
                                    <th>
                                        <center>
                                        <a href="{{url('perfil-colaborador/'.$colaborador->id_contador)}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-arrow-alt-circle-right"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#ModalActualizar{{$colaborador->id_contador}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        @if (Auth::user()->id_contador!=$colaborador->id_contador)
                                        <a data-toggle="modal" data-target="#ModalEliminar{{$colaborador->id_contador}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endif
                                        </center>
                                     </th>
                                </tr>
                                <div id="ModalEliminar{{$colaborador->id_contador}}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                多Estas seguro de eliminar a {{$colaborador->name}} del sistema?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                                <a type="button" href="{{url('eliminar-colaborador/'.$colaborador->id_contador)}}" class="btn btn-acontis">Eliminar</a>
                                            </div>
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
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group col">
                                                                <label for="">Cedula</label>
                                                                <input type="text" class="form-control" value="{{$colaborador->cedula}}" id="cedula" name="cedula">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group col">
                                                                <label for="">Nombres</label>
                                                                <input type="text" class="form-control" value="{{$colaborador->name}}" id="nombres" name="nombres">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group col">
                                                                <label for="">Telefono</label>
                                                                <input class="form-control" type="text" value="{{$colaborador->telefono}}" name="telefono" id="telefono">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group col">
                                                                <label for="">Direccion</label>
                                                                <input type="text" class="form-control" value="{{$colaborador->direccion}}" id="direccion" name="direccion">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group col">
                                                                <label for="">Correo</label>
                                                                <input class="form-control" type="email" value="{{$colaborador->email}}" name="correo" id="correo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <h4>Informacion Laboral</h4>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group col">
                                                                <label for="">Cargo</label>
                                                                <select class="form-control" name="cargo" id="cargo">
                                                                    <option value="" disabled  selected>Cargo</option>
                                                                    <option value="Gerente">Gerente</option> 
                                                                    <option value="Coordinador">Coordinador</option>
                                                                    <option value="Director">Director</option>
                                                                    <option value="Jefe">Jefe</option>
                                                                    <option value="Asistente">Asistente</option>
                                                                    <option value="Auxiliar">Auxiliar</option>
                                                                    <option value="Revisor Fiscal">Revisor Fiscal</option>
                                                                    <option value="Auditor Junior">Auditor Junior</option>
                                                                    <option value="Auditor Senior">Auditor Senior</option>
                                                                    <option value="Asesor Contable">Asesor Contable</option>
                                                                    <option value="Auxiliar Contable">Auxiliar Contable</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group col">
                                                                <label for="">EPS</label>
                                                                <input type="text" id="eps" name="eps" value="{{$colaborador->eps}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group col">
                                                                <label for="">Salario</label>
                                                                <input type="text" id="salario" name="salario" value="{{$colaborador->salario}}" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Descuentos</label>
                                                            <input type="text" name="descuentos" value="{{$colaborador->descuentos}}" id="descuentos" class="form-control">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label for="">Alergias</label>
                                                            <textarea name="alergias" id="alergias" cols="5" rows="5" class="form-control">{{$colaborador->alergias}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="">Antecedentes</label>
                                                            <textarea class="form-control" name="antecedentes" id="antecedentes" cols="5" rows="5">{{$colaborador->antecedentes}}</textarea>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <h4>Persona de Contacto</h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="">Persona de Contacto</label>
                                                            <input type="text" id="persona-contacto" value="{{$colaborador->nombre_contacto}}" name="persona-contacto" class="form-control">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Telefono de Contacto</label>
                                                            <input type="text" class="form-control" value="{{$colaborador->telefono_contacto}}" name="telefono-contacto" id="telefono-contacto" >
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
                            @endforeach
                            
                        @else
                            <div class="alert alert-warning" role="alert">
                                Hasta el momento no hay Registros en el sistema
                            </div>
                        @endif
                    </tbody>
                </table>
                <div id="ModalAgregar" class="modal fade ">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agregar Empleado</h5>
                            </div>
                                 
                            <div class="modal-body">
                                <form action="{{url('/agregar-colaborador')}}" method="post">
                           
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group col">
                                                <label for="">Cedula</label>
                                                <input type="text" class="form-control" id="cedula" name="cedula">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group col">
                                                <label for="">Nombres</label>
                                                <input type="text" class="form-control" id="nombres" name="nombres">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group col">
                                                <label for="">Telefono</label>
                                                <input class="form-control" type="text" name="telefono" id="telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col">
                                                <label for="">Direccion</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col">
                                                <label for="">Correo</label>
                                                <input class="form-control" type="email" name="correo" id="correo">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Informacion Laboral</h4>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group col">
                                                <label for="">Cargo</label>
                                                <select class="form-control" name="cargo" id="cargo">
                                                    <option value="" disabled  selected>Cargo</option>
                                                    <option value="Gerente">Gerente</option> 
                                                    <option value="Coordinador">Coordinador</option>
                                                    <option value="Director">Director</option>
                                                    <option value="Jefe">Jefe</option>
                                                    <option value="Asistente">Asistente</option>
                                                    <option value="Auxiliar">Auxiliar</option>
                                                    <option value="Revisor Fiscal">Revisor Fiscal</option>
                                                    <option value="Auditor Junior">Auditor Junior</option>
                                                    <option value="Auditor Senior">Auditor Senior</option>
                                                    <option value="Asesor Contable">Asesor Contable</option>
                                                    <option value="Auxiliar Contable">Auxiliar Contable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col">
                                                <label for="">EPS</label>
                                                <input type="text" id="eps" name="eps" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group col">
                                                <label for="">Salario</label>
                                                <input type="text" id="salario" name="salario" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Descuentos</label>
                                            <input type="text" name="descuentos" id="descuentos" class="form-control">
                                        </div>
                                        <div class="col-md-8">
                                            <label for="">Alergias</label>
                                            <textarea name="alergias" id="alergias" cols="5" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Antecedentes</label>
                                            <textarea class="form-control" name="antecedentes" id="antecedentes" cols="5" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Persona de Contacto</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Persona de Contacto</label>
                                            <input type="text" id="persona-contacto" name="persona-contacto" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Telefono de Contacto</label>
                                            <input type="text" class="form-control" name="telefono-contacto" id="telefono-contacto" >
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
            </div>
        </div>
    </div>
@endsection
