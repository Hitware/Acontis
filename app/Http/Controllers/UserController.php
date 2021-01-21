<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Empresa;

use App\Mail\RegistroMailable;
use Illuminate\Support\Facades\Mail;
use PDF;
class UserController extends Controller
{
    protected $table = 'contadores';

    public function colaboradores(){
        $id_user=auth()->user()->id_contador;
        $user = User::get()->where('id_contador','!=',$id_user);
        //$user = User::get();

        return view('colaboradores.colaboradores',array(
            'colaboradores'=>$user));
    }

    public function reportes(){
        $id_user=auth()->user()->id_contador;
        $user = User::get()->where('id_contador','!=',$id_user);
        //$user = User::get();

        return view('colaboradores.reportes',array(
            'colaboradores'=>$user));
    }

    public function agregar(Request $request){
        $colaborador = new User();
        $colaborador->cedula=$request->input('cedula');
        $colaborador->name=$request->input('nombres');
        $colaborador->telefono=$request->input('telefono'); 
        $colaborador->direccion=$request->input('direccion'); 
        $email=$colaborador->email=$request->input('correo'); 
        $colaborador->cargo=$request->input('cargo'); 
        $colaborador->eps=$request->input('eps'); 
        $colaborador->salario=$request->input('salario'); 
        $colaborador->descuentos=$request->input('descuentos'); 
        $colaborador->alergias=$request->input('alergias'); 
        $colaborador->antecedentes=$request->input('antecedentes'); 
        $colaborador->nombre_contacto=$request->input('persona-contacto'); 
        $colaborador->telefono_contacto=$request->input('telefono-contacto'); 
        $colaborador->password=bcrypt("123456");
        $colaborador->save();
        $correo = new RegistroMailable;
        Mail::to($email)->send($correo);
        return redirect()->route('colaboradores')->with(array(
            'message'=>'Colaborador Agregado'
        ));
    }

    public function actualizar($id,Request $request){
        $colaborador =  User::find($id);
        $colaborador->cedula=$request->input('cedula');
        $colaborador->name=$request->input('nombres');
        $colaborador->telefono=$request->input('telefono'); 
        $colaborador->direccion=$request->input('direccion'); 
        $email=$colaborador->email=$request->input('correo'); 
        $colaborador->cargo=$request->input('cargo'); 
        $colaborador->eps=$request->input('eps'); 
        $colaborador->salario=$request->input('salario'); 
        $colaborador->descuentos=$request->input('descuentos'); 
        $colaborador->alergias=$request->input('alergias'); 
        $colaborador->antecedentes=$request->input('antecedentes'); 
        $colaborador->nombre_contacto=$request->input('persona-contacto'); 
        $colaborador->telefono_contacto=$request->input('telefono-contacto'); 
        $colaborador->password=bcrypt("123456");
        $colaborador->update();
        return redirect()->route('colaboradores')->with(array(
            'message'=>'Registro Actualizado'
        ));
    }

    public function eliminar($id){
        $colaborador=User::find($id);
        $colaborador->delete();
        return redirect()->route('colaboradores')->with(array(
            'message'=>'Colaborador Eliminado'
        ));
    }

    public function asignaciones(){
        $id_user=auth()->user()->id_contador;
        $user = User::get()->where('id_contador','!=',$id_user);
        $empresas=Empresa::get();
        return view('colaboradores.asignaciones',array(
            'colaboradores'=>$user)    
        );
    }

    public function reportespdf(Request $request){
        $idcolaborador=$request->input('idcolaborador');
        $reportes=DB::table('companies_contadores')
        ->join('escaneos','companies_contadores.id_companycontador','=','escaneos.id_companie_contador')
        ->join('reportes','escaneos.id_codigo','=','reportes.id_codigo')
        ->join('companies','companies_contadores.id_company','=','companies.id_company')
        ->where('companies_contadores.id_contador','=',$idcolaborador )
        ->where('escaneos.estado_reporte','=','true')
        ->select('companies_contadores.*','escaneos.*','reportes.*','companies.*')
        ->get();
        return response(json_encode($reportes),200)->header('Content-type','text/plain');
    }

    public function login(Request $request){
        return "Accion prueba";
        die();
    }

}
