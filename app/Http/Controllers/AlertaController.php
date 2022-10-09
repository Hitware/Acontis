<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Alerta;
use App\Models\Empresa;

class AlertaController extends Controller
{
    protected $table = 'alertas';

    public function agregar($id_empresa,Request $request){
        $alerta=new Alerta();
        $alerta->alerta=$request->input('alerta');
        $alerta->fecha=$request->input('fecha');
        $alerta->descripcion=$request->input('descripcion');
        $alerta->estado='pendiente';
        $alerta->id_empresa=$id_empresa;
        $alerta->save();
        return back()->with('message','Alerta creada');
    }

}
