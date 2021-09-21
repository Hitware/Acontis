@extends('layouts.home')
@section('content')
    <a href="{{url('mi-informacion-contable')}}"><i class="fas fa-angle-double-left"></i></a>
    <br>
        @if($empresa[0]->servicio=="Revisoria Fiscal")
        <h4>Mis Dictamenes / Informes</h4>
        @else
            <h4>Mi Información Contable</h4>
        @endif
    <br>
    <div class="container-fluid">
        <div class="row">
            @foreach ($documentos as $documento)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <a href="#">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xm  font-weight-bold text-primary text-uppercase mb-1">
                                    @if (Storage::disk('documentosperiodo')->has($documento->url_documento))
                                        <a target="blank" href="{{url('/documentoperiodo/'.$documento->url_documento)}}">{{$documento->nombre_documento}}</a>    
                                    @endif 
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-pdf fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection