<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Configuracion;
use App\Models\Documento;
class ConfiguracionController extends Controller
{
    protected $table = 'configuracion';

    public function index(){
        $tipodocumentos=Configuracion::get();
        $documentos=Documento::where('tipo','=','0')
        ->get();
        return view('configuracion.index',array(
            'tipodocumentos'=>$tipodocumentos,
            'documentos'=>$documentos
        ));
    }

    public function agregar(Request $request){
        $tipodocumento=new Configuracion();
        $tipodocumento->nombre=$request->input('nombre');
        $tipodocumento->save();
        return redirect()->route('configuracion')->with(array(
            'message'=>'Registro completado'
        ));
    }

    public function eliminar($id,Request $request){
        $tipodocumento=Configuracion::find($id);
        $tipodocumento->delete();
        return redirect()->route('configuracion')->with(array(
            'message'=>'Registro eliminado'
        ));
    }

}
