<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Configuracion;
use App\Models\Titulo;
use App\Models\Educacion;
use App\Models\Formacion;
use App\Models\ExperienciaLaboral;
use App\Models\Anexo;
use App\Mail\RegistroMailable;
use Illuminate\Support\Facades\Mail;
use PDF;
class UserController extends Controller
{
    protected $table = 'contadores';

    public function colaboradores(){
        $id_user=auth()->user()->id_contador;
        $user = User::get()->where('id_contador','!=',$id_user)
        ->where('role_id','!=','5');

        //$user = User::get();

        return view('colaboradores.colaboradores',array(
            'colaboradores'=>$user));
    }

    public function reportes(){
        $id_user=auth()->user()->id_contador;
        $user = User::get()->where('id_contador','!=',$id_user)
        ->where('role_id','!=','5');
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

    public function actualizarPerfil($id,Request $request){
        $password=$request->input('password');
        $colaborador =  User::find($id);
        $colaborador->name=$request->input('nombre');
        $colaborador->cedula=$request->input('cedula');
        $colaborador->telefono=$request->input('telefono');
        $colaborador->email=$request->input('correo');
        $colaborador->direccion=$request->input('direccion');
        $colaborador->cumpleanos=$request->input('fecha-nacimiento');
        if($password!=""){
            $colaborador->password=bcrypt($password);
        }
        $colaborador->alergias=$request->input('alergias');
        $colaborador->antecedentes=$request->input('antecedentes');
        $colaborador->nombre_contacto=$request->input('nombre-contacto');
        $colaborador->telefono_contacto=$request->input('telefono-contacto');
        $imagen=$request->file('imagen');
        if($imagen){
            $imagen_path = time().$file->getClientOriginalName();;
            Storage::disk('fotoperfil')->put($imagen_path,\File::get($imagen));
            $colaborador->url_imagen=$imagen_path;
        }

        $colaborador->update();
        return back()->with('message','Actualizacion de perfil exitosa');
    }

    public function getImagen($filename){
        return Storage::response("fotoperfil/$filename");
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
        $user = User::get()->where('id_contador','!=',$id_user)
        ->where('role_id','!=','5');
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

    public function addusuarioempresa($companie_id, Request $request){
        $user = new User();
        $user->name=$request->input('nombre');
        $user->cargo=$request->input('cargo');
        $user->email=$request->input('correo');
        $user->password=bcrypt($request->input('password'));
        $user->companie_id=$companie_id;
        $user->role_id=5;
        $user->save();
        $message="Usuario Agregado Exitosamente";
        return back()->with('message',$message);
    }

    public function perfil($id,Request $request){
        $tipo_documentos=Configuracion::get();
        $colaborador = User::where('id_contador','=',$id)->get();
        $titulos = Titulo::where('id_contador','=',$id)
        ->join('tipo_documento','titulo.tipo_titulo','=','tipo_documento.idconfiguracion')->get();
        return view('colaboradores.perfil',array(
            'colaborador'=>$colaborador,
            'tipo_documentos'=>$tipo_documentos,
            'titulos'=>$titulos
        ));
    }

    public function perfilUsuario(){
        $tipo_documentos=Configuracion::get();
        $id_user=auth()->user()->id_contador;
        $colaborador = User::get()->where('id_contador','=',$id_user);
        $titulos = Titulo::where('id_contador','=',$id_user)
        ->join('tipo_documento','titulo.tipo_titulo','=','tipo_documento.idconfiguracion')->get();
        return view('colaboradores.perfiluser',array(
            'colaborador'=>$colaborador,
            'tipo_documentos'=>$tipo_documentos,
            'titulos'=>$titulos
        ));
    }

    public function hojadevida(){
        $id_user=auth()->user()->id_contador;
        $educacion=Educacion::where('id_usuario','=',$id_user)->get();
        $formacion=Formacion::where('id_usuario','=',$id_user)->get();
        $experiencia=ExperienciaLaboral::where('id_usuario','=',$id_user)->get();
        $anexos=Anexo::where('id_usuario','=',$id_user)->get();
        return view('colaboradores.hojadevida',array(
            'educacion'=>$educacion,
            'formacion'=>$formacion,
            'experiencia'=>$experiencia,
            'anexos'=>$anexos,
        ));
    }


}
