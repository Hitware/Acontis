@extends('layouts.home')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Lista de Empresas</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div id="container">
    <div id="right">
        <button data-toggle="modal" data-target="#ModalAgregar" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Agregar</span>
        </button>
        <a href="{{route('excel-empresas')}}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-file-excel"></i>
            </span>
            <span class="text">Excel</span>
        </a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6>Lista de Empresas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Nit</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Rep. Legal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($empresas)>0)
                        @foreach ($empresas as $empresa)
                            <tr>
                                <th>{{Str::limit($empresa->name_company, 20)}}</th>
                                <th>{{$empresa->nit_company}}</th>
                                <th>{{$empresa->email_company}}</th>
                                <th>{{$empresa->telephone_company}}</th>
                                <th>{{Str::limit($empresa->representante_legal, 20)}}</th>
                                <th>
                                    <a href="{{url('perfil-empresa/'.$empresa->id_company)}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-arrow-alt-circle-right"></i>
                                    </a>
                                    <a data-toggle="modal"
                                     data-target="#modalQR{{$empresa->id_company}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-qrcode"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#modalEnviar{{$empresa->id_company}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-share-square"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#ModalEditar{{$empresa->id_company}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#modalEliminar{{$empresa->id_company}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </th>
                            </tr>
                            <div id="modalQR{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                <div class="title m-b-md">
                                                    {!!QrCode::size(300)->generate($empresa->name_company) !!}
                                                 </div>
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modalEnviar{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Para confirmar el envio del QR a la empresa {{$empresa->name_company}} porfavor da clic en Enviar
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-acontis">Cerrar</button>
                                            <a type="button" href="{{url('enviar-qr/'.$empresa->id_company)}}" class="btn btn-acontis">Enviar</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modalEliminar{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar {{$empresa->name_company}} del sistema?
                                            <br>
                                            Todos los datos del sistema relacionados a esta empresa se eliminaran.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <a type="button" href="{{url('eliminar-empresa/'.$empresa->id_company)}}" class="btn btn-acontis">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="ModalEditar{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Editar Empresa</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('/actualizar-empresa',['id'=>$empresa->id_company])}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Nombre de la empresa</label>
                                                            <input type="text" id="nombre-empresa" name="nombre-empresa" value="{{$empresa->name_company}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Representante legal</label>
                                                            <input type="text" id="representante-legal" value="{{$empresa->representante_legal}}" name="representante-legal" class="form-control">
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Nit</label>
                                                            <input type="text" id="nit" value="{{$empresa->nit_company}}" name="nit" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group col">
                                                            <label for="">Correo principal</label>
                                                            <input type="text" id="correo" name="correo" value="{{$empresa->email_company}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group col">
                                                            <label for="">Telefono</label>
                                                            <input type="text" id="telefono" value="{{$empresa->telephone_company}}" name="telefono" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Tipo de Cliente</label>
                                                            <select name="tipo-cliente" id="tipo-cliente" class="form-control">
                                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                                <option value="CO">CO</option>
                                                                <option value="PH">PH</option>
                                                                <option value="PN">PN</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Servicio</label>
                                                            <select name="servicio" id="servicio" class="form-control">
                                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                                <option value="Contable">Contable</option>
                                                                <option value="Revisoría Fiscal">Revisoría Fiscal</option>
                                                                <option value="Auditoría">Auditoría</option>
                                                                <option value="Asesoria Tributaría">Asesoria Tributaría</option>
                                                                <option value="Declaración de Renta">Declaración de Renta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Dirección</label>
                                                            <input type="text" id="direccion" name="direccion" value="{{$empresa->address_company}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Base de Datos</label>
                                                            <input type="text" id="dbword" name="dbword" value="{{$empresa->name_bd_adm}}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                
                                                <button type="submit" class="btn btn-success">Actualizar</button>
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
            <div id="ModalAgregar" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Agregar Empresa</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('/agregar-empresa')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Nombre de la empresa</label>
                                            <input type="text" id="nombre-empresa" name="nombre-empresa" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Representante legal</label>
                                            <input type="text" id="representante-legal" name="representante-legal" class="form-control">
                                        </div>
                                    </div>  
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Nit</label>
                                            <input type="text" id="nit" name="nit" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col">
                                            <label for="">Correo principal</label>
                                            <input type="text" id="correo" name="correo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col">
                                            <label for="">Telefono</label>
                                            <input type="text" id="telefono" name="telefono" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Tipo de Cliente</label>
                                            <select name="tipo-cliente" id="tipo-cliente" class="form-control">
                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                <option value="CO">CO</option>
                                                <option value="PH">PH</option>
                                                <option value="PN">PN</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Servicio</label>
                                            <select name="servicio" id="servicio" class="form-control">
                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                <option value="Contable">Contable</option>
                                                <option value="Revisoría Fiscal">Revisoría Fiscal</option>
                                                <option value="Auditoría">Auditoría</option>
                                                <option value="Asesoria Tributaría">Asesoria Tributaría</option>
                                                <option value="Declaración de Renta">Declaración de Renta</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Dirección</label>
                                            <input type="text" id="direccion" name="direccion" class="form-control">
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
        </div>
    </div>
</div>
@endsection