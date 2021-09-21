<table border="1" >
    <tr>
    <td style="align-content: center" rowspan="2" colspan="7" ><img src="img/logo-reporte.png"></td>
    <td colspan="7" rowspan="2"><h1 style="font-size: 20px"><b>LISTA DE COLABORADORES</b></h1></td>
    <td style="align-content: center" rowspan="2" colspan="7"><img src="img/logo-certificacion.png"></td>
    </tr>
    <tr>
        <td><center></center></td>
        <td><center></center></td>
        <td><center></center></td>
    </tr>
    <thead>
        <thead>
            <tr>
                <th><b>NOMBRES</b></th>
                <th colspan="2"><b>CÉDULA</b></th>
                <th colspan="2"><b>CELULAR</b></th>
                <th colspan="3"><b>CORREO CORPORATIVO</b></th>
                <th colspan="2"><b>AÑOS</b></th>
                <th colspan="2"><b>CONTRATACIÓN</b></th>
                <th colspan="2"><b>FECHA DE CONTRATO</b></th>
                <th colspan="3"><b>CARGO</b></th>
                <th colspan="2"><b>SALARIO</b></th>
                <th colspan="3"><b>SEDE</b></th>
                <th colspan="2"><b>SEXO</b></th>
                <th colspan="4"><b>DIRECCIÓN</b></th>
                <th colspan="2"><b>VIVIENDA</b></th>
                <th colspan="2"><b>ESTADO CIVIL</b></th>
                <th><b>TALLA</b></th>
                <th colspan="2"><b>EPS</b></th>
                <th colspan="2"><b>PENSIÓN</b></th>
                <th colspan="2"><b>CESANTIAS</b></th>
                <th><b>RH</b></th>
                <th colspan="2"><b>ARL</b></th>
                <th colspan="3"><b>CAJA DE COMPENSACION</b></th>
                <th colspan="2"><b>CONVENIOS</b></th>
                <th colspan="2"><b>MEDICINA PREPAGADA</b></th>
                <th colspan="2"><b>TALLA CAMISA</b></th>
                <th colspan="2"><b>TALLA PANTALON</b></th>
                <th colspan="2"><b>TALLA ZAPATOS</b></th>

            </tr>
        </thead>
    </thead>
<tbody>
    @foreach ($colaboradores as $colaborador)
        @if ($colaborador->estado!="retirados")
        <tr>
            <th>{{$colaborador->name}} {{$colaborador->lastname}}</th>
            <th colspan="2">{{$colaborador->cedula}}</th>
            <th colspan="2">{{$colaborador->telefono}}</th>
            <th colspan="3">{{$colaborador->email}}</th>
            <th colspan="2">{{$colaborador->cumpleanos}}</th>
            <th colspan="2">{{$colaborador->tipo_contrato}}</th>
            <th colspan="2">{{$colaborador->fecha_ingreso}}</th>
            <th colspan="3">{{$colaborador->cargo}}</th>
            <th colspan="2">{{$colaborador->salario}}</th>
            <th colspan="3">{{$colaborador->ubicacion}}</th>
            <th colspan="2">{{$colaborador->sexo}}</th>
            <th colspan="4">{{$colaborador->direccion}}</th>
            <th colspan="2">{{$colaborador->vivienda}}</th>
            <th colspan="2">{{$colaborador->estado_civil}}</th>
            <th >{{$colaborador->talla}}</th>
            <th colspan="2">{{$colaborador->eps}}</th>
            <th colspan="2">{{$colaborador->pension}}</th>
            <th colspan="2">{{$colaborador->cesantias}}</th>
            <th >{{$colaborador->rh}}</th>
            <th colspan="2">{{$colaborador->arl}}</th>
            <th colspan="3">{{$colaborador->caja_compensacion}}</th>
            <th colspan="2">{{$colaborador->convenios}}</th>
            <th colspan="2">{{$colaborador->medicina_prepagada}}</th>
            <th colspan="2">{{$colaborador->talla}}</th>
            <th colspan="2">{{$colaborador->talla_pantalon}}</th>
            <th colspan="2">{{$colaborador->talla_zapatos}}</th>
        </tr>
        @endif
    @endforeach
</tbody>
    </table>