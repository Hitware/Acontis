<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Servicio;
class ServicioController extends Controller
{
    protected $table = 'servicios';
    
    public function agregar(Request $request){
        $servicio = new Servicio();
        $servicio->nombre= $request->input('nombre');
        $servicio->save();
        return back()->with('message','Servicio creado');
    }

    public function eliminar($id,Request $request){
        $servicio=Servicio::find($id);
        $servicio->delete();
        return back()->with('message','Servicio Eliminado');
    }
}
