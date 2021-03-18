<!DOCTYPE html>
<html>

<head>
    <style>
        .title {
            font-style: normal;
            font-weight: bold;
            font-size: 14pt;
            font-family: Arial;
            color: #000000;
        }

        .subtitle {
            font-style: italic;
            font-weight: bold;
            font-size: 14pt;
            font-family: Times New Roman;
            color: #000080;
        }

        .date-text {
            font-style: italic;
            font-weight: bold;
            font-size: 14pt;
            font-family: Times New Roman;
            color: #000080;
        }

        .text-tr {
            font-style: italic;
            font-weight: bold;
            font-size: 11pt;
            font-family: Times New Roman;
            color: #000080;
        }

        .table-main {
            background-color: #ffffff;
            filter: alpha(opacity=40);
            opacity: 0.95;
            border: 2px #000080 solid;
            border-spacing: 10px;
            border-left: 0px solid;
            border-right: 0px solid;
            width: 100%;
        }

        .table-not-main {
            background-color: #ffffff;
            filter: alpha(opacity=40);
            opacity: 0.95;
            border: 2px #000080 solid;
            border-spacing: 5px;
            border-left: 0px solid;
            border-right: 0px solid;
            border-top: 0px solid;
            width: 100%;
        }

        .title-customer {
            font-style: normal;
            font-weight: bold;
            font-size: 12pt;
            font-family: Arial;
            color: #000000;
        }

        .address-customer {
            font-style: normal;
            font-weight: bold;
            font-size: 9pt;
            font-family: Arial;
            color: #000000;
        }

        .account-tilte {
            font-style: italic;
            font-weight: bold;
            font-size: 9pt;
            font-family: Arial;
            color: #000080;
        }

        .text-tr-not-main {
            font-style: normal;
            font-weight: normal;
            font-size: 8pt;
            font-family: Times New Roman;
            color: #000000;
        }
    </style>
</head>

<body>
    <center>
        <h3 class="title">
            {{ $empresa->name_company }}
        </h3>
        <div>
            <span class="subtitle">
                Estado de Cuenta
            </span>
            <br>
            <span class="date-text">
                Entre {{ $fechaInicial }} Y {{ $fechaFinal }}
            </span>
        </div>

    </center>
    <br>
    <br>
    <br>

    <center>
        <table class="table-main">
            <tr>
                <td class="text-tr">
                    Fecha
                </td>
                <td class="text-tr">
                    Documento
                </td>
                <td class="text-tr">
                    Cuenta
                </td>
                <td class="text-tr">
                    Concepto
                </td>
                <td class="text-tr">
                    Saldo
                </td>
            </tr>
        </table>
    </center>
    <br>
    <span class="account-tilte">
        Cuentas por Cobrar
    </span>
    <br>
    <center>
        <table class="table-not-main">
        @foreach($movimientos as $mov)
            <tr>
                <td class="text-tr-not-main">
                    {{ $mov->Fecha }}
                </td>
                <td class="text-tr-not-main">
                    {{ $mov->Tipo_Documento }} - {{ $mov->Numero_Documento }}
                </td>
                <td class="text-tr-not-main">
                    {{ $mov->Codigo_Cuenta }}
                </td>
                <td class="text-tr-not-main">
                    {{ $mov->Concepto_Encabezado }} {{ $mov->Concepto_Detalle }}
                </td>
                <td class="text-tr-not-main">
                    {{ $mov->Débito + $mov->Crédito }}
                </td>
            </tr>
            @endforeach
        </table>
    </center>
</body>

</html>