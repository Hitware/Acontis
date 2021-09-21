<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Clasificacion;

class ClasificacionController extends Controller
{
    public function agregar(Request $request){
        $clasificacion = new Clasificacion();
        $clasificacion->nombre = $request->input('nombre');
        $clasificacion->save();
        return back()->with('message','Registro creado');
    }

    public function actualizar($id,Request $request){
        $clasificacion = Clasificacion::find($id);
        $clasificacion->nombre = $request->input('nombre');
        $clasificacion->save();
        return back()->with('message','Registro actualizado');
    }

    public function eliminar($id,Request $request){
        $clasificacion = Clasificacion::find($id);
        $clasificacion->delete();
        return back()->with('message','Registro eliminado');
    }
}
