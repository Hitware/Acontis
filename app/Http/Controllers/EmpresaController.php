<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Empresa;
use App\Models\EmpresaContador;
use App\Models\Reporte;
use App\Models\Alerta;
use App\Models\Documento;
use App\Models\Servicio;
use App\Models\TipoCliente;
use App\Models\Periodo;
use App\Models\RetiroEmpresa;

use Maatwebsite\Excel\Facades\Excel;
use App\Mail\QRMailable;
use Illuminate\Support\Facades\Mail;
use App\Exports\EmpresasExport;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use App\Models\CuentaPorCobrar;
use App\Models\CuentaPorCobrarDetallada;
use App\Models\CuentaPorPagar;
use App\Models\Clasificacion;
use App\Models\MovimientosContables;
use App\Models\DocumentoScanner;

class EmpresaController extends Controller
{
    protected $table = 'companies';

    public function empresas($sede){
        if($sede=="general"){
            $empresas=Empresa::where('sede','!=','retiradas')
            ->leftJoin('contadores','companies.id_asesor','=','contadores.id_contador')
            ->select('companies.*','contadores.name')
            ->get();
        }
        else if($sede=="acontis"){
            $empresas=Empresa::where('propietario','=','ACONTIS')
            ->where('sede','!=','retiradas')
            ->leftJoin('contadores','companies.id_asesor','=','contadores.id_contador')
            ->select('companies.*','contadores.name')
            ->get();
        }
        else if($sede=="guido"){
            $empresas=Empresa::where('propietario','=','GUIDO')
            ->where('sede','!=','retiradas')
            ->leftJoin('contadores','companies.id_asesor','=','contadores.id_contador')
            ->select('companies.*','contadores.name')
            ->get();
        }
        else if($sede=="retiradas"){
            $empresas=Empresa::join('empresa_retiro','companies.id_company','=','empresa_retiro.id_empresa')
            ->where('sede','=','retiradas')
            ->get();
        }
        else{
            $empresas=Empresa::where('sede','=',$sede)
            ->leftJoin('contadores','companies.id_asesor','=','contadores.id_contador')
            ->select('companies.*','contadores.name')
            ->get();
        }
        $servicios=Servicio::get();
        $tipoclientes=TipoCliente::get();
        $clasificacion=Clasificacion::get();
        return view('empresas.empresas',array(
            'empresas'=>$empresas,
            'servicios'=>$servicios,
            'tipoclientes'=>$tipoclientes,
            'clasificacion'=>$clasificacion
        ));
    }

    public function reportes(){
        $empresas=Empresa::get();
        return view('empresas.reportes',array(
            'empresas'=>$empresas
        ));
    }
    
    public function agregar(Request $request){
        $correo_empresa = $request->input('correo');
        $empresab = Empresa::where('email_company','=',$correo_empresa)->get();

        if(count($empresab)>0){
            return back()->with(array(
                'message'=>'Ya hay una empresa con este correo registrado'
            ));
        }
        else{
            $user_empresa= new User();
            $user_empresa->name=$request->input('nombre-empresa');
            $user_empresa->email=$request->input('correo');
            $user_empresa->password=bcrypt($request->input('nit'));
            $user_empresa->role_id=5;
            $user_empresa->save();

            $id_user =  User::latest('id_contador')->first(); 
            
            $hoy = new \DateTime();

            $empresa = new Empresa();
            $empresa->name_company=$request->input('nombre-empresa');
            $empresa->representante_legal=$request->input('representante-legal');
            $empresa->nit_company=$request->input('nit');
            $empresa->address_company=$request->input('direccion');
            $empresa->telephone_company=$request->input('telefono');
            $empresa->email_company=$request->input('correo');
            $empresa->tipo_cliente=$request->input('tipo-cliente');
            $empresa->clasificacion=$request->input('clasificacion');
            $empresa->servicio=$request->input('servicio');
            $empresa->sede=$request->input('sede');
            $empresa->propietario=$request->input('basedatos');
            $empresa->fecha_contrato=$hoy->format('Y-m-d');
            $empresa->user_id=$id_user->id_contador;
            $empresa->save(); 

            $id_companie =  Empresa::latest('id_company')->first(); 
            $iduser=$id_user->id_contador;
            $usercompanie = User::find($iduser);
            $usercompanie->companie_id=$id_companie->id_company;
            $usercompanie->update();
            
            return back()->with(array(
                'message'=>'Empresa registrada correctamente'
            ));
        }   
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
        $empresa->clasificacion=$request->input('clasificacion');
        $empresa->sede=$request->input('sede');
        $empresa->servicio=$request->input('servicio');
        $empresa->fecha_contrato=$request->input('fecha_contrato');
        $empresa->name_bd_adm=$request->input('dbword');
        $empresa->propietario=$request->input('basedatos');
        $user_id= $empresa->user_id;
        $empresa->update();
        
        $empresa_user=User::find($user_id);
        $empresa_user->email=$request->input('correo');
        $empresa_user->update();

        return back()->with(array(
            'message'=>'Empresa actualizada'
        ));


        
    }

    public function eliminar($idempresa,Request $request){
        $empresa=Empresa::find($idempresa);
        $empresa->sede='retiradas';
        $empresa->id_asesor=null;
        $empresa->id_asesordos=null;
        $empresa->update();

        $retiro = new RetiroEmpresa();
        $retiro->id_empresa=$idempresa;
        $retiro->motivo=$request->input('retiro');
        $retiro->save();

        return back()->with(array(
            'message'=>'Empresa retirada exitosamente'
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
        $fileName =  time().'.'. 'pdf' ;
        return $pdf->download($fileName);
    }

    public function generarEstadoCuentaPdf(Request $request, $id) {
        $request->validate([
            "fecha_inicial" => "required",
            "fecha_final" => "required",
            "codigo" => "required"
        ]);

        $empresa = Empresa::findOrFail($id);
        $empresa->changeConnection();
        $fechaInicial = $request->input("fecha_inicial");
        $fechaFinal = $request->input("fecha_final");
        
        $codigos = [
            "cuentas-por-cobrar" => [
                13
            ],
            "cuentas-por-pagar-a-proveedores" => [
                22
            ],
            "cuentas-por-pagar" => [
                23
            ],
            "ingresos-operacionales" => [
                41
            ],
            "ingresos-no-operacionales" => [
                42
            ],
            "gastos-operacionales" => [
                51
            ],
            "gastos-no-operacionales" => [
                53
            ]
        ];

        $tipo = \Str::title(str_replace("-", " ", $request->codigo));

        $codigoCuenta = $request->input("codigo");

        $movimientos = MovimientosContables::whereRaw("left(Codigo_Cuenta,2) = ?", $codigos[$codigoCuenta])
            ->whereBetween("Fecha", [$fechaInicial, $fechaFinal])
            ->orderByDesc("Fecha")
            ->get();

        $total = $movimientos->sum(fn($mov) => $mov->Débito + $mov->Crédito);

        $pdf = PDF::loadView('empresas.reportes.estado_cuenta', compact("empresa","fechaInicial", "fechaFinal", "movimientos", "tipo", "total"));

        //return view('empresas.reportes.estado_cuenta', compact("empresa","fechaInicial", "fechaFinal", "movimientos", "tipo"));

        return $pdf->download("{$fechaInicial}-{$fechaFinal}-{$empresa->name_company}.pdf");
    }

    public function getEstadoCuentaPdf() {
        return view('empresas.estado_cuenta');
    }
    

    public function misEmpresas(){
        $id_user=auth()->user()->id_contador;
        $empresas=Empresa::where('id_asesor','=',$id_user)->get();
        return view('colaboradores.empresas')->with(array(
            'empresas'=>$empresas
        ));
    }

    public function perfilEmpresa($idempresa){
        $empresa=Empresa::where('id_company','=',$idempresa)->first();
        $usuarios=User::where('companie_id','=',$idempresa)->get();
        $documentos=Documento::where('id_empresa','=',$idempresa)->get();
        $alertas=Alerta::where('id_empresa','=',$idempresa)->get();
        $scanner=DocumentoScanner::where('id_empresa','=',$idempresa)->get();
        $periodos=Periodo::where('id_companie','=',$idempresa)->get();

        return view('empresas.perfil')->with(
            compact(
                'empresa',
                'usuarios',
                'documentos',
                'alertas',
                'periodos',
                'scanner'
            )
        );
    }
}
