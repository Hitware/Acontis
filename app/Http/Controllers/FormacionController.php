<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Formacion;

class FormacionController extends Controller
{
   public function agregar(Request $request){
        $id_user=auth()->user()->id_contador;
        $formacion= new Formacion();
        $formacion->lugar_estudio=$request->input('lugar');
        $formacion->tiempo_estudio=$request->input('tiempo');
        $formacion->titulo_obtenido=$request->input('titulo');
        $formacion->id_usuario=$id_user;
        $formacion->save();
        return back()->with('message','Registro Creado');
    }

    public function eliminar($id,Request $request){
        $formacion=Formacion::find($id);
        $formacion->delete();
        return back()->with('message','Registro eliminado');
    }
}
