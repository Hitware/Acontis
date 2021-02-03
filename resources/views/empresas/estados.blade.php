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
</div>
