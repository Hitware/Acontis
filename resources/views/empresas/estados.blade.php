<div id="estados-table">
    <hr>
    <h4>Cuenta por cobrar</h3>
    <table class="table table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tipo de identificación</th>
                <th>Numero de identificación</th>
                <th>Tercero</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody v-for="(data,i) in por_cobrar" :key="i">
            <td>@{{ data.TipoDeIdentificacion }}</td>
            <td>@{{ data.Identificacion }}</td>
            <td>@{{ data.Nombres_terceros }}</td>
            <td>@{{ data.Saldo }}</td>
        </tbody>
    </table>
    <hr>
    <h4>Cuenta por cobrar detallada</h3>
    <table class="table table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tipo de identificación</th>
                <th>Numero de identificación</th>
                <th>Tercero</th>
                <th>Documento</th>
                <th>Saldo</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody v-for="(data,i) in por_cobrar_detallada" :key="i">
            <td>@{{ data.TipoDeIdentificacion }}</td>
            <td>@{{ data.Identificacion }}</td>
            <td>@{{ data.Nombres_terceros }}</td>
            <td>@{{ data.full_documento }}</td>
            <td>@{{ data.Saldo }}</td>
            <td>@{{ data.Fecha }}</td>
        </tbody>
    </table>
    <hr>
    <h4>Cuenta por pagar</h3>
    <table class="table table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tipo de identificación</th>
                <th>Numero de identificación</th>
                <th>Tercero</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody v-for="(data,i) in por_pagar" :key="i">
            <td>@{{ data.TipoDeIdentificacion }}</td>
            <td>@{{ data.Identificacion }}</td>
            <td>@{{ data.Nombres_terceros }}</td>
            <td>@{{ data.Saldo }}</td>
        </tbody>
    </table>
    <hr>
    <h4>Movimientos contables</h3>
    <table class="table table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Empleado</th>
                <th>Empresa</th>
                <th>Saldo</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody v-for="(data,i) in movimientos_contables" :key="i">
            <td>@{{ data.Concepto_Detalle }}</td>
            <td>@{{ data.Identificacion_Empleado }} @{{ data.Empleado }}</td>
            <td>@{{ data.Identificacion_Tercero }} @{{ data.Empresa }}</td>
            <td>@{{ data.Débito }}</td>
            <td>@{{ data.Fecha }}</td>
        </tbody>
    </table>
</div>
