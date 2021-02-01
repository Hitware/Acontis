@extends('layouts.home')
@section('content')
    <h2>Planeacion</h2>
@if (session('message'))
<div class="alert alert-warning" role="alert">
{{session('message')}}
</div>
@endif
<div id="container">
    <div id="left">
        <button data-toggle="modal" data-target="#ModalAgregar" class="btn btn-primary btn-icon-split">
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
        <h4>Visitas programadas</h4>
    </div>
    <div class="card-body">
        <div class="row header-calendar"  >

            <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
              <a  href="{{ asset('planeacion/') }}/<?= $data['last']; ?>" style="margin:10px;">
                <i class="fas fa-chevron-circle-left" style="font-size:30px;color:white;"></i>
              </a>
              <h2 style="font-weight:bold;margin:10px;"><?= $mespanish; ?> <small><?= $data['year']; ?></small></h2>
              <a  href="{{ asset('planeacion/') }}/<?= $data['next']; ?>" style="margin:10px;">
                <i class="fas fa-chevron-circle-right" style="font-size:30px;color:white;"></i>
              </a>
            </div>
    
          </div>
          <div class="row">
            <div class="col header-col">Lunes</div>
            <div class="col header-col">Martes</div>
            <div class="col header-col">Miercoles</div>
            <div class="col header-col">Jueves</div>
            <div class="col header-col">Viernes</div>
            <div class="col header-col">Sabado</div>
            <div class="col header-col">Domingo</div>
          </div>
          <!-- inicio de semana -->
          @foreach ($data['calendar'] as $weekdata)
            <div class="row">
              <!-- ciclo de dia por semana -->
              @foreach  ($weekdata['datos'] as $dayweek)
    
              @if  ($dayweek['mes']==$mes)
                <div class="col box-day">
                  {{ $dayweek['dia']  }}
                  <!-- evento -->
                  @foreach  ($dayweek['evento'] as $event)
                    @if ($event->jornada=="Mañana")
                    <a data-toggle="modal" data-target="#modalEvento{{$event->id_evento}}" class="badge badge-primary">
                        {{$empresa=Str::limit($event->name_company, 20)}}
                      </a>
                    @else
                    <a data-toggle="modal" data-target="#modalEvento{{$event->id_evento}}" class="badge badge-warning">
                        {{$empresa=Str::limit($event->name_company, 20)}}
                      </a>
                    @endif
                      
                      <div id="modalEvento{{$event->id_evento}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    Empresa: {{$event->name_company}}
                                    <br>
                                    Jornada: {{$event->jornada}}
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
              @else
              <div class="col box-dayoff">
              </div>
              @endif
    
    
              @endforeach
            </div>
          @endforeach
    
        <div id="ModalAgregar" class="modal fade ">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Visita</h5>
                    </div>
                         
                    <div class="modal-body">
                        <form action="{{url('agregar-planeacion')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group col">
                                        <label for="">Jornada</label>
                                        <select class="form-control" name="jornada" id="jornada">
                                            <option value="Mañana">Mañana</option>
                                            <option value="Tarde">Tarde</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group col">
                                        <label for="">Empresa</label>
                                        <select class="form-control" name="empresa" id="empresa" required>
                                            <option value="">--SELECCIONE--</option>
                                            @foreach ($empresas as $empresa)
                                                <option value="{{$empresa->id_company}}">{{$empresa->name_company}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group col">
                                        <label for="">Fecha y Hora</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                                    </div>
                                </div>
                            </div>
                           <hr>
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
@endsection