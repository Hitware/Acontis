<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Evento;

use App\Mail\QRMailable;
use Illuminate\Support\Facades\Mail;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventoController extends Controller
{
    public function eventos(){
        $evento=Evento::get();
        return view('eventos.eventos',array(
            'eventos'=>$evento
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
        $evento->ubicacion=$request->input('ubicacion');
        $evento->save();
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


}
