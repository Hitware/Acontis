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
                            <h6 class="user-email">{{$colaborador->email}}</h6>
                        </div>
                        <div class="about">
                            <h5>Cargo</h5>
                            <p>{{$colaborador->cargo}}</p>
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
                                <label for="nombre">Nombre completo</label>
                                <input type="text" class="form-control" value="{{$colaborador->name}}" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="cedula">Cédula</label>
                                <input type="text" class="form-control" value="{{$colaborador->cedula}}" id="cedula" name="cedula" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" value="{{$colaborador->email}}" id="correo" name="correo" placeholder="Correo">
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
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" value="{{$colaborador->telefono}}" id="telefono" name="telefono" placeholder="Teléfono">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="{{$colaborador->direccion}}" placeholder="Dirección">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fecha">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" value="{{$colaborador->cumpleanos}}"  id="fecha-nacimiento" name="fecha-nacimiento" placeholder="Fecha de nacimiento">
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
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mt-3 mb-2 text-primary">Información de Contacto</h6>
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
        </div>
        </div>
        </div>
    @endforeach
@endsection