<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Documento;

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

    public function getDocument($filename){
        return Storage::response("documentos/$filename");
    }

}
