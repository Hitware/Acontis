<?php

namespace App\Http\Controllers\Api;

use App\Models\CuentaPorCobrarDetallada;
use App\Http\Controllers\Controller;

class CuentaPorCobrarDetalladaController extends Controller
{
    public function index()
    {
        return CuentaPorCobrarDetallada::all();
    }
}
