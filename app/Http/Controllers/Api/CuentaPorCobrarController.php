<?php

namespace App\Http\Controllers\Api;

use App\Models\CuentaPorCobrar;
use App\Http\Controllers\Controller;

class CuentaPorCobrarController extends Controller
{
    public function index()
    {
        return CuentaPorCobrar::all();
    }
}
