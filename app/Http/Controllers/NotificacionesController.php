<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Notificaciones;

class NotificacionesController extends Controller
{
    protected $table = 'notificaciones';
    

    public function index(){
        $id_user=auth()->user()->role_id;
        $role=null;
        if($id_user=='3' or $id_user=='4'){
            $role=1;
        }
        else if($id_user==5){
            $role=2;
        }

        $notifications=Notificaciones::where('tipo','=',$role)->get();
        $notificaciones=Notificaciones::get();
        return view('alertas.index',array(
            'notificaciones'=>$notificaciones,
            
        ));
    }

    public function agregar(Request $request){
        $notificacion = new Notificaciones();
        $notificacion->tipo=$request->input('tipo'); 
        $notificacion->titulo=$request->input('titulo'); 
        $notificacion->mensaje=$request->input('notificacion'); 
        $notificacion->save();
        return redirect()->route('alertas')->with(array(
            'message'=>'Alerta enviada exitosamente'
        ));
    }

}
