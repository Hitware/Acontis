<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Periodo;
use App\Models\Empresa;
use App\Models\DocumentoPeriodo;

class PeriodoController extends Controller
{
    protected $table = 'periodo';

    public function editar($id,Request $request){
        $periodo= Periodo::find($id);
        $periodo->nombre_periodo=$request->input('periodo');
        $periodo->update();
        return back()->with('message','Periodo actualizado');
    }

    public function agregar($id,Request $request){
        $periodo=new Periodo();
        $periodo->nombre_periodo=$request->input('periodo');
        $periodo->id_companie=$id;
        $periodo->save();
        return back()->with('message','Periodo creado');
    }

    public function eliminar($id){
        $docs=DocumentoPeriodo::where('id_periodo','=',$id)->get();
        foreach($docs as $doc){
            Storage::disk('documentosperiodo')->delete($doc->url_documento);
            $doc->delete();
        }
        $periodo= Periodo::find($id);
        $periodo->delete();
        return back()->with('message','Periodo eliminado');
    }

    public function periodo($id){
        $documentosperiodo=DocumentoPeriodo::where('id_periodo','=',$id)->get();
        return view('empresas.documentosperiodo')->with(array(
            'periodo'=>$id,
            'documentos'=>$documentosperiodo
        ));
    }

    public function periodos(){
        $id_companie=auth()->user()->companie_id;
        $periodos=Periodo::where('id_companie','=',$id_companie)->get();
        $empresa=Empresa::where('id_company','=',$id_companie)->get();
        return view('empresas.periodos')->with(array(
            'periodos'=>$periodos,
            'empresa'=>$empresa
        ));
    }

    public function documentos($id){
        $id_companie=auth()->user()->companie_id;
        $empresa=Empresa::where('id_company','=',$id_companie)->get();
        $documentos=DocumentoPeriodo::where('id_periodo','=',$id)->get();
        return view('empresas.periodo.documentos')->with(array(
            'documentos'=>$documentos,
            'empresa'=>$empresa
        ));
    }

}
