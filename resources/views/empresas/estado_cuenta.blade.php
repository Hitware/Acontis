@extends('layouts.home')
@section('content')
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="row">
    <div class="container">
        <h4>
        En el presente apartado podrás obtener un reporte detallado de la cuenta que elijas!
        </h4>
    <br>
    <br>
        <form action="{{ route('generar-pdf-empresa', [ 'id' => Auth::user()->companie_id ]) }}" method="post">
                           
            {!! csrf_field() !!}                
                    
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group col">
                        <label for="">Tipo</label>
                        <select class="form-control" name="codigo" id="cargo" required>
                            <option value="cuentas-por-cobrar">Cuentas por cobrar</option>
                            <option value="cuentas-por-pagar">Cuentas por pagar</option>
                            <option value="cuentas-por-pagar-a-proveedores">Cuentas por pagar a proveedores</option>
                            <option value="ingresos-operacionales">Ingresos operacionales</option>
                            <option value="ingresos-no-operacionales">Ingresos no operacionales</option>
                            <option value="gastos-operacionales">Gastos operacionales</option>
                            <option value="gastos-no-operacionales">Gastos no operacionales</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="ro">
                <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha">Desde</label>
                            <input type="date" class="form-control" required name="fecha_inicial" placeholder="Desde">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha">Hasta</label>
                            <input type="date" class="form-control" name="fecha_final" required placeholder="Hasta">
                        </div>
                    </div>
            </div>
            <button style="margin-left: 1%;margin-top:1%" type="submit" class="btn btn-acontis">GENERAR</button>
        </form>
                       
    </div>
</div>

@endsection

