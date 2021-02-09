<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CuentaPorCobrarController;
use App\Http\Controllers\Api\CuentaPorPagarController;
use App\Http\Controllers\Api\MovimientosContablesController;
use App\Http\Controllers\Api\CuentaPorCobrarDetalladaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('empresa/{id}/cuentas-por-cobrar', [CuentaPorCobrarController::class, "index"])
    ->middleware("change-connection-company-bd")
    ->name("api.empresa.por_cobrar");

Route::get('empresa/{id}/cuentas-por-pagar', [CuentaPorPagarController::class, "index"])
    ->middleware("change-connection-company-bd")
    ->name("api.empresa.por_pagar");

Route::get('empresa/{id}/movimientos-contables', [MovimientosContablesController::class, "index"])
    ->middleware("change-connection-company-bd")
    ->name("api.empresa.movimientos_contables");

Route::get('empresa/{id}/cuenta-por-cobrar-detallada', [CuentaPorCobrarDetalladaController::class, "index"])
    ->middleware("change-connection-company-bd")
    ->name("api.empresa.por_cobrar.detalle");