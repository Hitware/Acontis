<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\HijoColaborador;
class HijoColaboradorController extends Controller
{
    public function agregar($id,Request $request){
        $hijocolaborador= new HijoColaborador();
        $hijocolaborador->nombres=$request->input('nombres');
        $hijocolaborador->sexo=$request->input('sexo');
        $hijocolaborador->fecha_nacimiento=$request->input('fecha_nacimiento');
        $hijocolaborador->id_colaborador=$id;
        $hijocolaborador->save();
        return back()->with('message','Registro creado');
    }

    public function actualizar($id,Request $request){
        $hijocolaborador= HijoColaborador::find($id);
        $hijocolaborador->nombres=$request->input('nombres');
        $hijocolaborador->sexo=$request->input('sexo');
        $hijocolaborador->fecha_nacimiento=$request->input('fecha_nacimiento');
        $hijocolaborador->update();
        return back()->with('message','Registro actualizado');
    }

    public function eliminar($id){
        $hijocolaborador= HijoColaborador::find($id);
        $hijocolaborador->delete();
        return back()->with('message','Registro eliminado');
    }
}
