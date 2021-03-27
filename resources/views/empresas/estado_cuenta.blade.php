@extends('layouts.home')
@section('content')
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif

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
    <button type="submit" class="btn btn-success">GENERAR</button>
</form>

@endsection

