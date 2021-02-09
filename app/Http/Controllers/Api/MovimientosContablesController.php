<?php

namespace App\Http\Controllers\Api;

use App\Models\MovimientosContables;
use App\Http\Controllers\Controller;

class MovimientosContablesController extends Controller
{
    public function index()
    {
        return MovimientosContables::where("Tipo_Documento","rc")->get();
    }
}
