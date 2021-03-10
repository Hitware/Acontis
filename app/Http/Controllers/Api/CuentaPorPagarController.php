<?php

namespace App\Http\Controllers\Api;

use App\Models\CuentaPorPagar;
use App\Http\Controllers\Controller;

class CuentaPorPagarController extends Controller
{
    public function index()
    {
        return CuentaPorPagar::paginate(100);
    }
}
