@extends('layouts.home')
@section('content')
    @if (session('message'))    
    <div class="alert alert-warning" role="alert">
        {{session('message')}}
    </div>  
    @endif
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#ModalAgregarExperiencia" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="ModalAgregarExperiencia">
                    <h6 class="m-0 font-weight-bold text-primary">Experiencia Laboral</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="ModalAgregarExperiencia">
                    <div class="card-body">
                        <div id="container">
                            <div id="left">
                                <button data-toggle="modal" data-target="#ModalAgregarExperiencia" class="btn btn-acontis btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Agregar</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Tiempo</th>
                                            <th>Jefe Inmediato</th>
                                            <th>
                                                
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($experiencia)>0)
                                            @foreach ($experiencia as $experiencia)
                                                <tr>
                                                    <td>{{$experiencia->lugar}}</td>
                                                    <td>{{$experiencia->tiempo_trabajo}}</td>
                                                    <td>{{$experiencia->jefe_inmediato}}</td>
                                                    <td>
                                                        <a data-toggle="modal" data-target="#ModalEliminarExperiencia{{$experiencia->id_experiencia}}" class="btn btn-acontis btn-circle btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <div id="ModalEliminarExperiencia{{$experiencia->id_experiencia}}" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ¿Estas seguro de eliminar este registro de tu hoja de vida?
                                                                    <br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                                                    <a type="button" href="{{url('eliminar-experiencia/'.$experiencia->id_experiencia)}}" class="btn btn-acontis">Eliminar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="ModalAgregarExperiencia" class="modal fade ">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Agregar Experiencia</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('/agregar-experiencia')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Lugar de Trabajo</label>
                                                        <input type="text" class="form-control" id="lugar" name="lugar">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Tiempo de Trabajo</label>
                                                        <input type="text" class="form-control" id="tiempo" name="tiempo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Jefe Inmediato</label>
                                                        <input class="form-control" type="text" name="jefe" id="jefe">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Fecha de Terminación de Contrato</label>
                                                        <input class="form-control" type="date" name="fechacontrato" id="fechacontrato">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Tipo de Contrato</label>
                                                        <input class="form-control" type="text" name="tipocontrato" id="tipocontrato">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            
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
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardEducacion" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardEducacion">
                    <h6 class="m-0 font-weight-bold text-primary">Educación</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardEducacion">
                    <div class="card-body">
                        <div id="container">
                            <div id="left">
                                <button data-toggle="modal" data-target="#ModalAgregarEducación" class="btn btn-acontis btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Agregar</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Lugar de Estudio</th>
                                            <th>Titulo</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($educacion)>0)
                                            @foreach ($educacion as $educacion)
                                                <tr>
                                                    <td>{{$educacion->lugar_estudio}}</td>
                                                    <td>{{$educacion->titulo_obtenido}}</td>
                                                    <td>
                                                        <a data-toggle="modal" data-target="#ModalEliminarEducacion{{$educacion->id_educacion}}" class="btn btn-acontis btn-circle btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                    <div id="ModalEliminarEducacion{{$educacion->id_educacion}}" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ¿Estas seguro de eliminar este registro de tu hoja de vida?
                                                                    <br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                                                    <a type="button" href="{{url('eliminar-educacion/'.$educacion->id_educacion)}}" class="btn btn-acontis">Eliminar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="ModalAgregarEducación" class="modal fade ">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Agregar Educacion</h5>
                                    </div>
                                         
                                    <div class="modal-body">
                                        <form action="{{url('/agregar-educacion')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Lugar de Estudio</label>
                                                        <input type="text" class="form-control" id="lugar" name="lugar">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Tiempo de Estudio</label>
                                                        <input type="text" class="form-control" id="tiempo" name="tiempo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group col">
                                                        <label for="">Titulo Recibido</label>
                                                        <input class="form-control" type="text" name="titulo" id="titulo">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            
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
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardAnexos" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardAnexos">
                    <h6 class="m-0 font-weight-bold text-primary">Anexos</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardAnexos">
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection