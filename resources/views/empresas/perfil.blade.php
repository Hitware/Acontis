@extends('layouts.home')
@section('content')
@foreach ($empresa as $empresa)
<h1 class="h3 mb-2 text-gray-800">{{$empresa->name_company}}</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6></h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#inicio" role="tab" aria-controls="home" aria-selected="true">Usuarios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#documentos" role="tab" aria-controls="profile" aria-selected="false">Documentos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#estados" role="tab" aria-controls="contact" aria-selected="false">Estados Contables</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#alertas" role="tab" aria-controls="contact" aria-selected="false">Alertas</a>
              </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="inicio" role="tabpanel" aria-labelledby="home-tab">
                @include('empresas.usuarios')
            </div>
            <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="profile-tab">
                @include('empresas.documentos')
            </div>
            <div class="tab-pane fade" id="estados" role="tabpanel" aria-labelledby="contact-tab">
                3
            </div>
            <div class="tab-pane fade" id="alertas" role="tabpanel" aria-labelledby="contact-tab">
                @include('empresas.alertas')
            </div>
          </div> 
    </div>
</div>
@endforeach
@endsection