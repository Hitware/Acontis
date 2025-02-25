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
use Carbon\Carbon;

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

    public function generarpdf($id){
        $empresa=Empresa::where('id_company','=',$id)->get();
        $fechacontrato=$empresa[0]->fecha_contrato;
        $fechacontrato = Carbon::parse($fechacontrato);
        $fechacon = Carbon::parse($fechacontrato);
        $diacontrato = $fechacon->day;
        $aniocontrato = $fechacon->year;
        $fecha = Carbon::parse(date('Y-m-d'));
        $date=$fecha->locale('es');
        $date=$fechacontrato->locale('es');
        $mes=($fecha->monthName);
        $mescontrato=($fechacontrato->monthName);
        $pdf = PDF::loadView('reportes.referencia',compact('empresa','mes','mescontrato','diacontrato','aniocontrato'));
        return $pdf->download('Referencia Comercial'.$empresa[0]->name_company.'.pdf');
    }

}
