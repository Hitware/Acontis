<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\TipoCliente;
class TipoClienteController extends Controller
{
    protected $table = 'tipoclientes';

    public function agregar(Request $request){
        $servicio = new TipoCliente();
        $servicio->nombre= $request->input('nombre');
        $servicio->save();
        return back()->with('message','Registro creado');
    }

    public function actualizar($id, Request $request){
        $servicio = TipoCliente::find($id);
        $servicio->nombre= $request->input('nombre');
        $servicio->update();
        return back()->with('message','Registro actualizado');
    }

    public function eliminar($id,Request $request){
        $servicio=TipoCliente::find($id);
        $servicio->delete();
        return back()->with('message','Registro eliminado');
    }
}
