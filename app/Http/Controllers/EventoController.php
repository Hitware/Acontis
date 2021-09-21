<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Evento;
use App\Models\TipoCliente;
use App\Models\Empresa;
use App\Models\User;
use App\Models\Cargo;
use App\Mail\EventoMailable;
use Illuminate\Support\Facades\Mail;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventoController extends Controller
{
    public function eventos(){
        $evento=Evento::get();
        $tipocliente=TipoCliente::get();
        $cargo=Cargo::get();
        return view('eventos.eventos',array(
            'eventos'=>$evento,
            'tipocliente'=>$tipocliente,
            'cargos'=>$cargo,

        ));
    }

    public function agregar(Request $request){
        $evento = new Evento();
        $evento->fecha=$request->input('fecha');
        $evento->nombre=$request->input('nombre');
        $evento->descripcion=$request->input('descripcion');
        $evento->tipo=$request->input('tipo');
        $evento->horario=$request->input('hora');
        $evento->invitados=$request->input('invitados');
        $evento->clasificacion=$request->input('clasificacion');
        $evento->ubicacion=$request->input('ubicacion');
        $evento->save();
        if($request->input('clasificacion')!=null){
            if($request->input('clasificacion')=="Todas"){
                $empresas=Empresa::get();
                foreach($empresas as $empresa){
                $email=$empresa->email_company;
                $nombre_empresa=$empresa->name_company;
                $data=array(
                    'nombre_empresa'=>$nombre_empresa,
                    'nombre_evento'=>$evento->nombre,
                    'descripcion_evento'=>$evento->descripcion
                );
                Mail::to($email)->send(new EventoMailable($data));
                }
            }
            else{
                $empresas=Empresa::where('tipo_cliente','=',$evento->clasificacion)->get();
                foreach($empresas as $empresa){
                $email=$empresa->email_company;
                $nombre_empresa=$empresa->name_company;
                $data=array(
                    'nombre_empresa'=>$nombre_empresa,
                    'nombre_evento'=>$evento->nombre,
                    'descripcion_evento'=>$evento->descripcion
                );
                Mail::to($email)->send(new EventoMailable($data));
                }
            }
        }
        if($request->input('invitados')=='Colaboradores'){
            $users=User::where('role_id','=','4')
            ->orWhere('role_id','=','3')->get();
            foreach($users as $user){
                if($user->email!=''){
                    $email=$user->email;
                    $nombre=$user->name;
                    $data=array(
                        'nombre_empresa'=>$nombre,
                        'nombre_evento'=>$evento->nombre,
                        'descripcion_evento'=>$evento->descripcion
                    );
                    Mail::to($email)->send(new EventoMailable($data));
                }
            }

        }
        return redirect()->route('eventos')->with(array(
            'message'=>'Evento agregada exitosamente'
        ));
    }

    public function eliminar($idevento){
        $evento = Evento::find($idevento);
        $evento->delete();
        return redirect()->route('eventos')->with(array(
            'message'=>'Evento eliminado exitosamente'
        ));
    }

    public function actualizar($id,Request $request){
        $evento =  Evento::find($id);
        $evento->fecha=$request->input('fecha');
        $evento->nombre=$request->input('nombre');
        $evento->descripcion=$request->input('descripcion');
        $evento->tipo=$request->input('tipo');
        $evento->horario=$request->input('hora');
        $evento->invitados=$request->input('invitados');
        $evento->ubicacion=$request->input('ubicacion');
        $evento->update();
        return redirect()->route('eventos')->with(array(
            'message'=>'Evento actualizado exitosamente'
        ));
    }

    public function reporte($id){

        $evento= Evento::where('id_actividad','=',$id)->get();
        $asistentes=DB::table('asistencias')
        ->join('actividades','asistencias.id_actividades','=','actividades.id_actividad')
        ->join('contadores','asistencias.id_contador','=','contadores.id_contador')
        ->where('asistencias.id_actividades','=',$id)
        ->select('asistencias.*','contadores.*','actividades.*')
        ->get();
        $pdf = PDF::loadView('reportes.asistencias',compact('asistentes','evento'));
        return $pdf->download('Reporte de Asistencias.pdf');
        

    }




}
