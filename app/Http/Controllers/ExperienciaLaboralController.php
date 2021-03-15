<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\ExperienciaLaboral;

class ExperienciaLaboralController extends Controller
{
    protected $table = 'experiencia_laboral';
    public function agregar(Request $request){
        $id_user=auth()->user()->id_contador;
        $experiencia= new ExperienciaLaboral();
        $experiencia->id_usuario=$id_user;
        $experiencia->lugar=$request->input('lugar');
        $experiencia->tiempo_trabajo=$request->input('tiempo');
        $experiencia->jefe_inmediato=$request->input('jefe');
        $experiencia->fecha_fincontrato=$request->input('fechacontrato');
        $experiencia->tipo_contrato=$request->input('tipocontrato');
        $experiencia->save();
        return back()->with('message','Registro Creado');
    }
    
    public function eliminar($id,Request $request){
        $experiencia=ExperienciaLaboral::find($id);
        $experiencia->delete();
        return back()->with('message','Registro eliminado');
    }

}
