<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Titulo;

class TituloController extends Controller
{
    protected $table = 'titulo';

    public function agregar($id,Request $request){
        $titulo = new Titulo();
        $titulo->tipo_titulo=$request->input('tipo-documento');
        $titulo->id_contador=$id;
        $file=$request->file('documento');
        if($file){
            $documento_path = time().$file->getClientOriginalName();
            Storage::disk('titulos')->put($documento_path,\File::get($file));
            $titulo->ubicacion=$documento_path;
        }
        $titulo->save(); 
        return back()->with('message','Documento Cargado');
    }

    public function getTitulo($filename){
        return Storage::response("titulos/$filename");
    }

}
