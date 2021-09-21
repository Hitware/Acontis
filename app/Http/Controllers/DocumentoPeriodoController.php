<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\DocumentoPeriodo;

use App\Mail\PeriodoMailable;
use Illuminate\Support\Facades\Mail;

class DocumentoPeriodoController extends Controller
{
    public function agregar($id,Request $request){
        $documentoperiodo=new DocumentoPeriodo();
        $documentoperiodo->nombre_documento=$request->input('nombredocumento');
        $documentoperiodo->id_periodo=$id;
        $file=$request->file('documento');
            if($file){
                $documento_path = time().$file->getClientOriginalName();
                Storage::disk('documentosperiodo')->put($documento_path,\File::get($file));
                $documentoperiodo->url_documento=$documento_path;
            }
        $documentoperiodo->save(); 
        return back()->with('message','Documento Cargado');
    }

    public function getDocument($filename){
        return Storage::response("documentosperiodo/$filename");
    }

    public function enviar($id,Request $request){
        $email=$request->input('email');
        $mensaje=$request->input('mensaje');
        $documentos= DocumentoPeriodo::where('id_periodo','=',$id)->get();
        $data=array(
            'mensaje'=>$mensaje,
            'documentos'=>$documentos
        );
        Mail::to($email)->send(new PeriodoMailable($data));
        return back()->with(array('message'=>'Documentos Enviados'));
    }

    public function eliminar($id){
        $documento=DocumentoPeriodo::find($id);
        Storage::disk('documentosperiodo')->delete($documento->url_documento);
        $documento->delete();
        return back()->with(array('message'=>'Documento eliminado'));

    }
}
