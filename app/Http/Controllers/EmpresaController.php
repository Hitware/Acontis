<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Empresa;
use App\Models\EmpresaContador;
use App\Models\Reporte;
use App\Models\Documento;

use Maatwebsite\Excel\Facades\Excel;
use App\Mail\QRMailable;
use Illuminate\Support\Facades\Mail;
use App\Exports\EmpresasExport;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
class EmpresaController extends Controller
{
    protected $table = 'companies';

    public function empresas(){
        $empresas=Empresa::get();
        return view('empresas.empresas',array(
            'empresas'=>$empresas
        ));
    }

    public function reportes(){
        $empresas=Empresa::get();
        return view('empresas.reportes',array(
            'empresas'=>$empresas
        ));
    }
    
    public function agregar(Request $request){

        $empresa = new Empresa();
        $empresa->name_company=$request->input('nombre-empresa');
        $empresa->representante_legal=$request->input('representante-legal');
        $empresa->nit_company=$request->input('nit');
        $empresa->address_company=$request->input('direccion');
        $empresa->telephone_company=$request->input('telefono');
        $empresa->email_company=$request->input('correo');
        $empresa->tipo_cliente=$request->input('tipo-cliente');
        $empresa->servicio=$request->input('servicio');
        $empresa->save();
        return redirect()->route('empresas')->with(array(
            'message'=>'Empresa agregada exitosamente'
        ));
        
    }

    public function actualizar($id,Request $request){
        $empresa =  Empresa::find($id);
        $empresa->name_company=$request->input('nombre-empresa');
        $empresa->representante_legal=$request->input('representante-legal');
        $empresa->nit_company=$request->input('nit');
        $empresa->address_company=$request->input('direccion');
        $empresa->telephone_company=$request->input('telefono');
        $empresa->email_company=$request->input('correo');
        $empresa->tipo_cliente=$request->input('tipo-cliente');
        $empresa->servicio=$request->input('servicio');
        $empresa->update();
        return redirect()->route('empresas')->with(array(
            'message'=>'Empresa actualizada exitosamente'
        ));
        
    }

    public function eliminar($idempresa){
        $empresa=Empresa::find($idempresa);
        $empresa->delete();
        return redirect()->route('empresas')->with(array(
            'message'=>'Empresa eliminada exitosamente'
        ));
    }

    

    public function enviarCorreo($id){
        $email=DB::table('companies')->where('id_company','=',$id)->value('email_company');
        $nombre_empresa=DB::table('companies')->where('id_company','=',$id)->value('name_company');
        $qr = QrCode::format('png')->size(200)->generate($nombre_empresa);
        $data = array(
            'qr'        => $qr,
            'nombre_empresa'=>$nombre_empresa,
        );
        Mail::to($email)->send(new QRMailable($data));

        return redirect()->route('empresas')->with(array(
            'message'=>'Correo enviado exitosamente'
        ));
    }

    public function empresasAsignadas(Request $request){
        $idasesor=$request->input('idasesor');
        $empresas = Empresa::where('id_asesor','=',$idasesor)
                    ->orWhere('id_asesordos','=',$idasesor)->get();
        return response(json_encode($empresas),200)->header('Content-type','text/plain');
    }

    public function empresasTotal(Request $request){
        $empresas = Empresa::get();
        return response(json_encode($empresas),200)->header('Content-type','text/plain');
    }

    public function asignarEmpresa(Request $request){
        $idasesor=$request->input('asesorid');
        $idempresa=$request->input('idempresa');
        
        $buscar=Empresa::find($idempresa);
        $actual=$buscar->id_asesor;

        if($actual!=""){
            return "R";
        }
        else{
            $empresac= EmpresaContador::where('id_company','=',$idempresa)->first();
            if($empresac!=""){
                $empresac->id_contador=$idasesor;
                $empresac->update();
            }
            else{
                $empresac= new EmpresaContador();
                $empresac->id_contador=$idasesor;
                $empresac->id_company=$idempresa;
                $empresac->clase=$idempresa;
                $empresac->estado="a";
                $empresac->clase='p';
                $empresac->save();
            }
            $empresa=Empresa::find($idempresa);
            $empresa->id_asesor=$idasesor;
            $empresa->update();
            return "Asignación exitosa";
            
            }
    }

    public function asignarEmpresaP(Request $request){
        $idasesor=$request->input('asesorid');
        $idempresa=$request->input('idempresa');
        
        $empresac= EmpresaContador::where('id_company','=',$idempresa)
                    ->where('clase','=','p')->first();
        if($empresac!=""){
            $empresac->id_contador=$idasesor;
            $empresac->update();
        }
        
        $empresa=Empresa::find($idempresa);
        $empresa->id_asesor=$idasesor;
        $empresa->update();
        return "Asignación exitosa";
    }

    public function asignarEmpresaS(Request $request){
        $idasesor=$request->input('asesorid');
        $idempresa=$request->input('idempresa');
        
        $empresac= EmpresaContador::where('id_company','=',$idempresa)
                    ->where('clase','=','s')->first();
        if($empresac!=""){
            $empresac->id_contador=$idasesor;
            $empresac->update();
        }
        else{
            $empresac= new EmpresaContador();
            $empresac->id_contador=$idasesor;
            $empresac->id_company=$idempresa;
            $empresac->clase='s';
            $empresac->estado="a";
            $empresac->save();
        }
        $empresa=Empresa::find($idempresa);
        $empresa->id_asesordos=$idasesor;
        $empresa->update();
        return "Asignación exitosa";
    }

    public function desasignar(Request $request){
        $idasesor=$request->input('asesorid');
        $idempresa=$request->input('idempresa');
       
        $empresa=Empresa::find($idempresa);
        if($empresa->id_asesor==$idasesor){
            $empresa->id_asesor=null;
            $empresa->update();
        }
        else if($empresa->id_asesordos==$idasesor){
            $empresa->id_asesordos=null;
            $empresa->update();
        }
        return "Proceso culminado";
    }

    public function excel(){    
        return Excel::download(new EmpresasExport,'reporte-empresas.xlsx');
    }

    public function reportespdf(Request $request){
        $idempresa=$request->input('idempresa');
        $reportes=DB::table('companies_contadores')
        ->join('escaneos','companies_contadores.id_companycontador','=','escaneos.id_companie_contador')
        ->join('reportes','escaneos.id_codigo','=','reportes.id_codigo')
        ->join('contadores','companies_contadores.id_contador','=','contadores.id_contador')
        ->where('companies_contadores.id_company','=',$idempresa )
        ->where('escaneos.estado_reporte','=','true')
        ->select('companies_contadores.*','escaneos.*','reportes.*','contadores.*')
        ->get();
        
        return response(json_encode($reportes),200)->header('Content-type','text/plain');
    }

    public function generarpdf($id_reporte){
        $reportes=DB::table('reportes')
        ->join('escaneos','reportes.id_codigo','=','escaneos.id_codigo')
        ->join('companies_contadores','escaneos.id_companie_contador','=','companies_contadores.id_companycontador')
        ->join('contadores','companies_contadores.id_contador','=','contadores.id_contador')
        ->where('reportes.id_reporte','=',$id_reporte)
        ->select('escaneos.*','reportes.*','contadores.*')
        ->get();
        $pdf = PDF::loadView('reportes.visitas',compact('reportes'));
        $path = public_path('/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);
        $pdf = public_path($fileName);
        return response()->download($pdf);
    }

    public function misEmpresas(){
        $id_user=auth()->user()->id_contador;
        $empresas=Empresa::where('id_asesor','=',$id_user)->get();
        return view('colaboradores.empresas')->with(array(
            'empresas'=>$empresas
        ));
    }

    public function perfilEmpresa($idempresa){
        $empresa=Empresa::where('id_company','=',$idempresa)->get();
        $documentos=Documento::where('id_empresa','=',$idempresa)->get();
        return view('empresas.perfil')->with(array(
            'empresa'=>$empresa,
            'documentos'=>$documentos
        ));
    }


}
