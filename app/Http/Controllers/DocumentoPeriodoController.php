<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\DocumentoPeriodo;

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
}
