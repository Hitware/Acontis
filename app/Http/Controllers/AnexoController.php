<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Anexo;
class AnexoController extends Controller
{
    public function agregar(Request $request){
        $id_user=auth()->user()->id_contador;
        $anexo = new Anexo();
        $anexo->nombre=$request->input('nombre');
        $anexo->id_usuario=$id_user;
        $imagen=$request->file('anexo');
        if($imagen){
            $imagen_path = time().$file->getClientOriginalName();;
            Storage::disk('anexos')->put($imagen_path,\File::get($imagen));
            $anexo->url_anexo=$imagen_path;
        }
        $anexo->save();
        return back()->with('message','Anexo Creado');
    }

    public function eliminar($id,Request $request){
        $anexo=Anexo::find($id);
        $anexo->delete();
        return back()->with('message','Anexo Eliminado');

    }
}
