<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Periodo;
use App\Models\DocumentoPeriodo;

class PeriodoController extends Controller
{
    protected $table = 'periodo';

    public function agregar($id,Request $request){
        $periodo=new Periodo();
        $periodo->nombre_periodo=$request->input('periodo');
        $periodo->id_companie=$id;
        $periodo->save();
        return back()->with('message','Periodo creado');
    }

    public function periodo($id){
        $documentosperiodo=DocumentoPeriodo::where('id_periodo','=',$id)->get();
        return view('empresas.documentosperiodo')->with(array(
            'periodo'=>$id,
            'documentos'=>$documentosperiodo
        ));
    }
}
