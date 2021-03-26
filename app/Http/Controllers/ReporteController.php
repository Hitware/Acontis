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

    public function indicadores(){
        return view('reportes.indicadores');
    }

    public function reportes(){

        $idempresa=auth()->user()->companie_id;

        $reportes=DB::table('companies_contadores')
        ->join('escaneos','companies_contadores.id_companycontador','=','escaneos.id_companie_contador')
        ->join('reportes','escaneos.id_codigo','=','reportes.id_codigo')
        ->join('contadores','companies_contadores.id_contador','=','contadores.id_contador')
        ->where('companies_contadores.id_company','=',$idempresa )
        ->where('escaneos.estado_reporte','=','true')
        ->where('reportes.tipo_reporte','=','Actividad')
        ->select('companies_contadores.*','escaneos.*','reportes.*','contadores.*')
        ->get();

        $visitas=DB::table('companies_contadores')
        ->join('escaneos','companies_contadores.id_companycontador','=','escaneos.id_companie_contador')
        ->join('reportes','escaneos.id_codigo','=','reportes.id_codigo')
        ->join('contadores','companies_contadores.id_contador','=','contadores.id_contador')
        ->where('companies_contadores.id_company','=',$idempresa )
        ->where('escaneos.estado_reporte','=','true')
        ->where('reportes.tipo_reporte','=','Visita')
        ->select('companies_contadores.*','escaneos.*','reportes.*','contadores.*')
        ->get();

        return view('empresas.listreportes',array(
            'reportes'=>$reportes,
            'visitas'=>$visitas,
        ));
    }

}
