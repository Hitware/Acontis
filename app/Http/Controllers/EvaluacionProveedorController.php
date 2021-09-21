<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\EvaluacionProveedor;
class EvaluacionProveedorController extends Controller
{
    public function agregar($id,Request $request){
        $evaluacion = new EvaluacionProveedor();
        $evaluacion->id_empresa=$id;
        $evaluacion->nombre=$request->input('nombre_documento');
        $documento=$request->file('documento');
        if($documento){
            $evaluacion_path = time().$documento->getClientOriginalName();
            Storage::disk('evaluacion')->put($evaluacion_path,\File::get($documento));
            $evaluacion->url_documento=$evaluacion_path;
        }
        $evaluacion->save();
        return back()->with('message','Evaluación cargada');
    }
}
