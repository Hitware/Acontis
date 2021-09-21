@extends('layouts.home')
@section('content')
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<br>
<h3>CERTIFICACIONES</h3>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <a href="{{url('referencia-comercial/'.Auth::user()->companie_id)}}">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xm  font-weight-bold text-primary text-uppercase mb-1">
                            Referencia Comercial
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
    </div>
</div>
<br>
<h3>DESCARGABLES</h3>
<br>
       
<div class="container-fluid">
    <div class="row">
        @foreach ($documentos as $documento)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xm  font-weight-bold text-primary text-uppercase mb-1">
                                @if (Storage::disk('documentosacontis')->has($documento->documento))
                                <a target="blank" href="{{url('/documentoacontis/'.$documento->documento)}}">{{$documento->nombre}}</a>    
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