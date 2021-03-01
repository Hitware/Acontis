<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Documento;
use App\Models\Empresa;
use PDF;

class DocumentoController extends Controller
{
    protected $table = 'documentos';
    
    public function agregar($id_empresa, Request $request){
        $documento = new Documento();
        $documento->nombre=$request->input('clase-documento');
        $documento->id_empresa=$id_empresa;

        $file=$request->file('documento');
            if($file){
                $documento_path = time().$file->getClientOriginalName();
                Storage::disk('documentos')->put($documento_path,\File::get($file));
                $documento->documento=$documento_path;
            }
        $documento->save(); 
        return back()->with('message','Documento Cargado');
    }

    public function add(Request $request){
        $documento = new Documento();
        $documento->nombre=$request->input('nombre');
        $documento->tipo=0;

        $file=$request->file('documento');
            if($file){
                $documento_path = time().$file->getClientOriginalName();
                Storage::disk('documentosacontis')->put($documento_path,\File::get($file));
                $documento->documento=$documento_path;
            }
        $documento->save(); 
        return back()->with('message','Documento Cargado');
    }

    public function modificar($id_documento, Request $request){
        $documento = Documento::find($id_documento);
        $file=$request->file('documentou');
            if($file){
                $documento_path = time().$file->getClientOriginalName();
                Storage::disk('documentos')->put($documento_path,\File::get($file));
                $documento->documento=$documento_path;
            }
        $documento->update(); 
        return back()->with('message','Documento Cargado');
        
    }

    public function getDocument($filename){
        return Storage::response("documentos/$filename");
    }

    public function getDocEmpresa($filename){
        return Storage::response("documentosacontis/$filename");
    }

    public function solicitud(){
        $documentos=Documento::where('tipo','=','0')
        ->get();
        return view('empresas.solicitudes',array(
            'documentos'=>$documentos
        ));
    }

    public function generarpdf(){
        $id_empresa=auth()->user()->companie_id;
        $empresa=Empresa::where('id_company','=',$id_empresa)->get();
        $fecha = \Carbon\Carbon::parse(date('Y-m-d'));
        $date=$fecha->locale('es');
        $mes=($fecha->monthName);
        $pdf = PDF::loadView('reportes.referencia',compact('empresa','mes'));
        $path = public_path('/');
        $fileName =  time().'.'. 'pdf';
        $pdf->save($path . '/' . $fileName);
        $pdf = public_path($fileName);
        return response()->download($pdf);
    }

}
