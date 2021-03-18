<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Educacion;

class EducacionController extends Controller
{
    protected $table = 'educacion';

    public function agregar(Request $request){
        $id_user=auth()->user()->id_contador;
        $educacion= new Educacion();
        $educacion->lugar_estudio=$request->input('lugar');
        $educacion->tiempo_estudio=$request->input('tiempo');
        $educacion->titulo_obtenido=$request->input('titulo');
        $educacion->id_usuario=$id_user;
        $educacion->save();
        return back()->with('message','Registro Creado');
    }

    public function eliminar($id,Request $request){
        $educacion=Educacion::find($id);
        $educacion->delete();
        return back()->with('message','Registro eliminado');
    }
}
