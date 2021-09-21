@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Acontisitos</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Padre</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($acontisitos)>0)
                        @foreach ($acontisitos as $hijo)
                            <tr>
                                <th>{{$hijo->nombres}}</th>
                                <th>{{\Carbon\Carbon::createFromDate($hijo->fecha_nacimiento)->age}} años</th>
                                <th>{{$hijo->sexo}}</th>
                                <th>{{$hijo->name}}{{$hijo->lastname}}</th>
                                
                            </tr>
                        @endforeach
                    @else
                    <div class="alert alert-warning" role="alert">
                        Hasta el momento no hay notificaciones registradas
                    </div>
                    @endif
                </tbody>
            </table>
            
        </div>
    </div>
</div>
@endsection