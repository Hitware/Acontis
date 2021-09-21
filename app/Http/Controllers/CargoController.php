<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Cargo;

class CargoController extends Controller
{
    public function agregar(Request $request){
        $cargo = new Cargo();
        $cargo->nombre=$request->input('nombre');
        $cargo->descripcion_cargo=$request->input('descripcion');
        $cargo->save();
        return back()->with('message','Cargo agregado');
    }

    public function actualizar($id, Request $request){
        $cargo= Cargo::find($id);
        $cargo->nombre=$request->input('nombre');
        $cargo->descripcion_cargo=$request->input('descripcion');
        $cargo->update();
        return back()->with('message','Cargo actualizado');
    }

    public function eliminar($id){
        $cargo= Cargo::find($id);
        $cargo->delete();
        return back()->with('message','Cargo eliminado');
    }

}
