<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\MovimientosContables;
use App\Http\Controllers\Controller;

class MovimientosContablesController extends Controller
{
    public function index(Request $request)
    {
        $codigos = [
            "cuentas-por-cobrar" => [
                13
            ],
            "cuentas-por-pagar-proveedores" => [
                22
            ],
            "cuentas-por-pagar" => [
                23
            ],
            "ingresos-operacionales" => [
                41
            ],
            "ingresos-no-operacionales" => [
                42
            ]
        ];

        $fechaInicial = $request->input("fecha_inicial");
        $fechaFinal = $request->input("fecha_final");

        $codigoCuenta = $request->input("codigo");

        return MovimientosContables::where("Tipo_Documento","rc")
                ->when($request->input("codigo"), function($query) use($codigos, $codigoCuenta) {
                    return $query->whereRaw("left(Codigo_Cuenta,2) = ?", $codigos[$codigoCuenta]);
                })
                ->when($fechaInicial && $fechaFinal, function($query) use($fechaInicial, $fechaFinal) {
                    return $query->whereBetween("Fecha", [$fechaInicial, $fechaFinal]);
                })->paginate(100);
    }
}
