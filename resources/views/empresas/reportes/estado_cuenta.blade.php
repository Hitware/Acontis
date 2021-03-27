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
            border-spacing: 7px;
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
    <div style="width: 100%">
            <div>
                <img width="100%" src="{{URL::asset('img/encabezado-reporte.png')}}" alt="">
            </div>
    </div>
    <center>
        <h3 class="title">
            {{ $empresa->name_company }}
        </h3>
        <div>
            <span class="subtitle">
                {{ $tipo }}
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
                <td class="text-tr" style="width:15%">
                    Fecha
                </td>
                <td class="text-tr" style="width:15%">
                    Documento
                </td>
                <td class="text-tr" style="width:15%">
                    Cuenta
                </td>
                <td class="text-tr" style="width:40%">
                    Concepto
                </td>
                <td class="text-tr" style="width:15%">
                    Saldo
                </td>
            </tr>
        </table>
    </center>
    <center>
        <table class="table-not-main">
        @foreach($movimientos as $mov)
            <tr>
                <td class="text-tr-not-main" style="width:15%">
                    {{ \Carbon\Carbon::parse($mov->Fecha)->format("Y-m-d") }}
                </td>
                <td class="text-tr-not-main" style="width:15%">
                    {{ $mov->Tipo_Documento }} - {{ $mov->Numero_Documento }}
                </td>
                <td class="text-tr-not-main" style="width:15%">
                    {{ $mov->Codigo_Cuenta }}
                </td>
                <td class="text-tr-not-main" style="width:40%">
                    {{ $mov->Concepto_Encabezado }} {{ $mov->Concepto_Detalle }}
                </td>
                <td class="text-tr-not-main" style="width:15%">
                    $ {{ number_format($mov->Débito + $mov->Crédito,  2) }}
                </td>
            </tr>
            @endforeach
        </table>
    </center>

    <center>
        <table class="table-not-main">
            <tr>
                <td class="text-tr-not-main" style="width:75%">
                    TOTAL
                </td>
                <td class="text-tr-not-main" style="width:5%">
                    
                </td>
                <td class="text-tr-not-main" style="width:5%">
                    
                </td>
                <td class="text-tr-not-main" style="width:5%">
                    
                </td>
                <td class="text-tr-not-main" style="width:15%">
                    $ {{ number_format($total) }}
                </td>
            </tr>
        </table>
    </center>    
</body>

</html>