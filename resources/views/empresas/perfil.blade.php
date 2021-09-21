@extends('layouts.home')
@section('content')
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
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#documentos" role="tab" aria-controls="profile" aria-selected="false">Scanner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#alertas" role="tab" aria-controls="contact" aria-selected="false">Alertas</a>
              </li>
              @if (Auth::user()->role_id!=5)
              <li class="nav-item">
                <a class="nav-link" id="infocontable-tab" data-toggle="tab" href="#infocontable" role="tab" aria-controls="infocontable" aria-selected="false">Información Contable</a>
              </li>
              @endif
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="inicio" role="tabpanel" aria-labelledby="home-tab">
                @include('empresas.usuarios')
            </div>
            <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="profile-tab">
                @include('empresas.documentos')
            </div>
            <div class="tab-pane fade" id="alertas" role="tabpanel" aria-labelledby="contact-tab">
                @include('empresas.alertas')
            </div>
            <div class="tab-pane fade" id="infocontable" role="tabpanel" aria-labelledby="infocontable-tab">
                @include('empresas.estados')
            </div>
          </div> 
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script>
  var app = new Vue({
    el: '#estados-table',
    data: {
      por_cobrar: [],
      por_pagar : [],
      por_cobrar_detallada : [],
      movimientos_contables : [],
    },
    mounted() {
      let vm = this;

      axios.defaults.headers.common['Authorization'] = "Bearer {{ auth()->user()->createToken('authToken')->accessToken }}";


      axios.get('{{ route("api.empresa.por_cobrar", [ "id" => request()->route("id") ]) }}')
        .then(function (response) {
          vm.por_cobrar = response.data.data;
        });

      axios.get('{{ route("api.empresa.por_pagar", [ "id" => request()->route("id") ]) }}')
        .then(function (response) {
          vm.por_pagar = response.data.data;
        });
      
      axios.get('{{ route("api.empresa.movimientos_contables", [ "id" => request()->route("id") ]) }}')
        .then(function (response) {
          vm.movimientos_contables = response.data.data;
        });

      axios.get('{{ route("api.empresa.por_cobrar.detalle", [ "id" => request()->route("id") ]) }}')
        .then(function (response) {
          vm.por_cobrar_detallada = response.data.data;
        });
    }
  })
</script>
@endsection
