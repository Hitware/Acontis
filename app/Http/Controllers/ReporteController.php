<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Reporte;
class ReporteController extends Controller
{
    protected $table = 'reportes';

    public function cliente($id){
        return view('reportes.reporte');
    }

    public function actualizar($id,Request $request){
        $reporte = Reporte::find($id);
        $reporte->estado=$request->input('estado');
        $reporte->comentarios=$request->input('comentarios');
        $reporte->save();
        return view('reportes.gracias');
    }

}
