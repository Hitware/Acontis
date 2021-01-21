@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Mis Empresas</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        
    </div>
    <div class="card-body">
        
    </div>
</div>

@endsection