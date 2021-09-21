<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use PDF;
use App\Models\CertificadoLaboral;
use Carbon\Carbon;
use NumeroALetras\NumeroALetras;
class CertificadoLaboralController extends Controller
{

    public function certificaciones(){
        $id_colaborador=auth()->user()->id_contador;;
        $certificaciones=CertificadoLaboral::where('id_colaborador','=',$id_colaborador)->get();
        return view('colaboradores.certificaciones',array(
            'certificaciones'=>$certificaciones
        ));
    }

    public function solicitar($id,Request $request){
        $certificado= new CertificadoLaboral();
        $certificado->id_colaborador=$id;
        $certificado->estado='Solicitado';
        $certificado->tipo_certificado=$request->input('tipo');
        $certificado->save();
        return back()->with('message','Certificado Solicitado');
    }

    public function certificados(){
        $certificados= CertificadoLaboral::join('contadores','certificado_laboral.id_colaborador','=','contadores.id_contador')
        ->select('contadores.name','contadores.lastname','certificado_laboral.*')
        ->get();
        return view('colaboradores.certificados',array('certificaciones'=>$certificados));
    }

    public function aprobar($id){
        $certificado=CertificadoLaboral::find($id);
        $certificado->estado="Aprobado";
        $certificado->fecha_aprobacion=date('Y-m-d');
        $certificado->update();
        return back()->with('message','Certificado aprobado');
    }

    public function rechazar($id){
        $certificado=CertificadoLaboral::find($id);
        $certificado->estado="Rechazado";
        $certificado->update();
        return back()->with('message','Certificado rechazado');
    }

    public function descargar($id){
        $certificado=CertificadoLaboral::join('contadores','certificado_laboral.id_colaborador','=','contadores.id_contador')
        ->select('contadores.*','certificado_laboral.*')
        ->where('id_certificado','=',$id)
        ->get();

        $fecha_aprobacion=$certificado[0]->fecha_aprobacion;
        $tipo_contrato=$certificado[0]->tipo_contrato;
        $tipo_certificado=$certificado[0]->tipo_certificado;
        $salario=$certificado[0]->salario;


        if($tipo_contrato=="PS"){
            $tp="PRESTACIÓN DE SERVICIOS";
        }
        if($tipo_contrato=="LABORAL"){
            $tp="LABORAL";
        }
        $fecha_aprob = Carbon::parse($fecha_aprobacion);
        $dia_aprobacion=$fecha_aprob->day;
        $year_aprobacion=$fecha_aprob->year;

        $date=$fecha_aprob->locale('es');
        $mes=($fecha_aprob->monthName);
        
        if($tipo_certificado==1){
            $pdf = PDF::loadView('certificaciones.vinculacion',compact('certificado','mes','dia_aprobacion','year_aprobacion','tp'));
        }
        else if($tipo_certificado==2){
            $pdf = PDF::loadView('certificaciones.vinculacionb',compact('certificado','mes','dia_aprobacion','year_aprobacion','tp'));
        }
        else if($tipo_certificado==3){
            $pdf = PDF::loadView('certificaciones.vinculacionf',compact('certificado','mes','dia_aprobacion','year_aprobacion','tp'));
        }
        $fileName =  'Certificado Laboral-'.$certificado[0]->name.''.$certificado[0]->lastname.'.'. 'pdf' ;
        return $pdf->download($fileName);
    }
}
