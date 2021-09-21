<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Sede;

class SedeController extends Controller
{
    protected $table = 'sedes';

    function agregar(Request $request){
        $sede = new Sede();
        $sede->nombre_ciudad=$request->input('nombre');
        $sede->save();
        return back()->with('message','Sede creada');
    }

    function actualizar($id,Request $request){
        $sede = Sede::find($id);
        $sede->nombre_ciudad=$request->input('nombre');
        $sede->update();
        return back()->with('message','Sede actualizada');
    }

    function eliminar($id,Request $request){
        $sede = Sede::find($id);
        $sede->delete();
        return back()->with('message','Sede eliminada');
    }

}
