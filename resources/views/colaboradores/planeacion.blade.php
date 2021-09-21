@extends('layouts.home')
@section('content')
    <h2>Planeación</h2>
@if (session('message'))
<div class="alert alert-warning" role="alert">
{{session('message')}}
</div>
@endif
<div id="container">
    <div id="left">
        <br>
        <button data-toggle="modal" data-target="#ModalAgregar" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Agregar</span>
        </button>
        <br style="margin-bottom: 3%">
        <h3>Estados de visitas programadas</h3>
        <br>
        <button style="background-color: #2196f3" class="btn btn-primary btn-icon-split">
           <span class="text">Programada</span>
        </button>
        <button style="background-color: #ffc107 " class="btn btn-primary btn-icon-split">
            
            <span class="text">Reprogramada</span>
        </button>
        <button style="background-color: #ff9800 " class="btn btn-primary btn-icon-split">
            
            <span class="text">Esperando Confirmación</span>
        </button>
        <button style="background-color: #4caf50 " class="btn btn-primary btn-icon-split">
            
            <span class="text">Visita Cumplida</span>
        </button>
    </div>
</div>
<br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">          
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
                                    @if (Auth::user()->role_id=='3')
                                    <div class="col-md-6">
                                        <div class="form-group col">
                                            <label for="">Asesor</label>
                                            <select class="form-control" name="asesor" id="asesor" required>
                                                <option value="">--SELECCIONE--</option>
                                                @foreach ($usuarios as $usuario)
                                                    <option value="{{$usuario->id_contador}}">{{$usuario->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                <div class="col-md-6">
                                    <div class="form-group col">
                                        <label for="">Fecha y Hora</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col">
                                        <label for="">Descripcion</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                                    </div>
                                </div>
                            </div>
                        <hr>
                            <br>
                            <button type="submit" class="btn btn-acontis">Guardar</button>
                            <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
        
        <div id='calendar'></div>
        <div id="ModalInfo" class="modal fade ">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Información de Visita</h5>
                    </div>
                    
                    

                    <div class="modal-body" id="info-visita">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>DETALLES DE VISITA PROGRAMADA</h5>
                                <div class="container">
                                    <label for="" id="openasesor"></label>
                                    <br>
                                    <label for="" id="openjornada"></label>
                                    <br>
                                    <label for="" id="openempresa"></label>
                                    <br>
                                    <label for="" id="openestado"></label>
                                    <br>
                                    <label for="" id="opendescripcion"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>INCIDENCIAS</h5>
                                
                            </div>
                            <hr style="width:100%;text-align:left;margin-left:0">
                        
                            <h5>ACTUALIZAR DATOS DE VISITA</h5>
                            <br>
                            <form action="actualizar-planificacion" method="POST" id="form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Jornada</label>
                                            <select class="form-control" name="jornadaopen" id="jornadaopen">
                                                <option value="Mañana">Mañana</option>
                                                <option value="Tarde">Tarde</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Empresa</label>
                                            <select class="form-control" name="empresaopen" id="empresaopen" required>
                                                <option value="">--SELECCIONE--</option>
                                                @foreach ($empresas as $company)
                                                    <option value="{{$company->id_company}}">{{$company->name_company}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fecha y Hora</label>
                                            <input type="date" class="form-control" id="fechaopen" name="fechaopen" required>
                                            <input type="hidden" class="form-control" id="idvisitaopen" name="idvisitaopen" required>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-acontis" id="btnUpdate">Actualizar</button>
                        <button class="btn btn-danger" id="btnBorrar">Borrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <link href="{{URL::asset('fullcalendar/fullcalendar.min.css')}}" rel='stylesheet' />
    <link href="{{URL::asset('fullcalendar/fullcalendar.print.min.css')}}" rel='stylesheet' media='print' />
    <link rel="stylesheet" href="{{URL::asset('fullcalendar/jquery-ui.css')}}">
    <script src="{{URL::asset('fullcalendar/moment.min.js')}}"></script>
    <script src="{{URL::asset('fullcalendar/jquery.min.js')}}"></script>
    <script src="{{URL::asset('fullcalendar/fullcalendar.min.js')}}"></script>
    <script>
        jQuery(document).ready(function($) {
        $('#calendar').fullCalendar({
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
            },
            buttonText: {
            today:    'Hoy',
            month:    'Mes',
            week:     'Semana',
            day:      'Día',
            list:     'Lista'
            },
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true,
             // allow "more" link when too many events
            events : [
                @foreach($visitas as $visita)
                {    
                    title : '{{$visita->name_company}}-{{$visita->name}}',
                    empresa : '{{$visita->name_company}}',
                    start : '{{$visita->fecha}}',
                    jornada:'{{$visita->jornada}}',
                    asesor:'{{$visita->name}}',
                    idevento:'{{$visita->id_evento}}',
                    color:'{{$visita->color}}',
                    estado:'{{$visita->estado}}',
                    descripcion:'{{$visita->descripcion}}',
                },
                @endforeach
            ],
            eventClick: function(event) {
                if (event.title) {
                    $("#openempresa").html(" Empresa: "+event.empresa);
                    $("#openjornada").html(" Jornada: "+event.jornada);
                    $("#openasesor").html(" Asesor: "+event.asesor);
                    $("#openestado").html(" Estado: "+event.estado);
                    $("#opendescripcion").html(" Descripcion: "+event.descripcion);
                    $("#idvisitaopen").val(event.idevento);
                    jQuery("#ModalInfo").modal("show");
                    
                return false;
                }
            },
            

        });

        $("#btnUpdate").click(function(){
            $.ajax({
                method:"POST",
                url:"actualizar-planificacion",
                data:$("#form").serialize(),
                success:function(data){
                    jQuery("#ModalInfo").modal("hide");
                    
                }
            })
        })
        $("#btnBorrar").click(function(){
            $.ajax({
                method:"POST",
                url:"borrar-planificacion",
                data:$("#form").serialize(),
                success:function(data){
                    jQuery("#ModalInfo").modal("hide");
                    jQuery('#calendar').fullCalendar('renderEvent', event, true);
                }
            })           
        })

        });
        
    </script>

@endsection
