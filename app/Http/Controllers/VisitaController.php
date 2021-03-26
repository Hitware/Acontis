<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visita;
use App\Models\Empresa;
use App\Models\User;

class VisitaController extends Controller
{
    protected $table = 'evento';
    
    public function planeacion($sede){
        $id_user=auth()->user()->id_contador;

        if(auth()->user()->role_id=='3'){
            $empresas=Empresa::get()
            ->where('sede','=',$sede)
            ->sortBy('name_company');
        }
        else{
            $empresas=Empresa::where('id_asesor','=',$id_user)
            ->where('sede','=',$sede)
            ->orWhere('id_asesordos','=',$id_user)->get()->sortBy('name_company');
        }
        $usuarios=User::where('role_id','!=','5')->get()->sortBy('name');
        $visitas=DB::table('evento')
            ->join('companies','evento.id_empresa','=','companies.id_company')
            ->join('contadores','evento.id_contador','=','contadores.id_contador')
            ->select('contadores.*','companies.*','evento.*')
            ->where('companies.sede','=',$sede)
            ->get();
        return view('colaboradores.planeacion',array(
            'empresas'=>$empresas,
            'visitas'=>$visitas,
            'usuarios'=>$usuarios
        ));
    }

    public function planeacionasesor(){
        $id_user=auth()->user()->id_contador;

        if(auth()->user()->role_id=='3'){
            $empresas=Empresa::get()
            ->sortBy('name_company');
        }
        else{
            $empresas=Empresa::get()
            ->sortBy('name_company');
        }
        $usuarios=User::where('role_id','!=','5')->get()->sortBy('name');
        $visitas=DB::table('evento')
            ->join('companies','evento.id_empresa','=','companies.id_company')
            ->join('contadores','evento.id_contador','=','contadores.id_contador')
            ->select('contadores.*','companies.*','evento.*')
            ->get();
        return view('colaboradores.planeacion',array(
            'empresas'=>$empresas,
            'visitas'=>$visitas,
            'usuarios'=>$usuarios
        ));
    }

    public function agregar(Request $request){
        $evento = new Visita();
        $evento->jornada=$request->input('jornada');
        $evento->fecha=$request->input('fecha');
        $evento->id_empresa=$request->input('empresa');
        $evento->descripcion=$request->input('descripcion');
        $evento->estado='Programado';
        if($evento->jornada=="Mañana"){
        $evento->color='#2196f3';
        }
        else{
        $evento->color='#072a65';
        }
        if($request->input('asesor')!=null){
            $evento->id_contador=$request->input('asesor');
        }
        else{
            $evento->id_contador=auth()->user()->id_contador;
        }
        $evento->save();
        return back()->with(array(
            'message'=>'Visita programada correctamente'
        ));
    }

    public function update(Request $request){
        $id_visita= $request->input('idvisitaopen');
        $planificacion = Visita::find($id_visita);
        $planificacion->jornada=$request->input('jornadaopen');
        $planificacion->fecha=$request->input('fechaopen');
        $planificacion->id_empresa=$request->input('empresaopen');
        $evento->estado='Reprogramada';
        $evento->color='#ffc107';
        $planificacion->update();
        return redirect()->route('planeacion')->with(array(
            'message'=>'Datos actualizados correctamente'
        ));
    }

    public function borrar(Request $request){
        $id_visita= $request->input('idvisitaopen');
        $planificacion = Visita::find($id_visita);
        $planificacion->delete();
        return redirect()->route('planeacion')->with(array(
            'message'=>'Datos borrados correctamente'
        ));
    }

}
