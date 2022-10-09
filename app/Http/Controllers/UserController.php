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
use App\Models\Cargo;
use App\Models\Retiro;
use App\Models\HijoColaborador;
use App\Mail\RegistroMailable;
use Illuminate\Support\Facades\Mail;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ColaboradoresExport;
use App\Exports\ColaboradoresExportRetirados;
class UserController extends Controller
{
    protected $table = 'contadores';

    public function colaboradores($estado){
        
        if($estado=="retirados"){
            $user= User::join('colaborador_retiro','contadores.id_contador','=','colaborador_retiro.id_colaborador')
            ->where('role_id','!=','5')
            ->where('estado','=',$estado)
            ->get();
        }
        else{
            $user = User::get()
            ->where('role_id','!=','5')
            ->where('estado','=',$estado);
        }
        $cargos = Cargo::get();
        return view('colaboradores.colaboradores',array(
            'colaboradores'=>$user,
            'cargos'=>$cargos
        ));
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
        $colaborador->lastname=$request->input('apellidos');
        $colaborador->hijos=$request->input('hijos');
        $colaborador->telefono=$request->input('telefono'); 
        $colaborador->correo_personal=$request->input('correo-personal'); 
        $email=$colaborador->email=$request->input('correo'); 
        $colaborador->cumpleanos=$request->input('cumpleanos'); 
        $colaborador->direccion=$request->input('direccion'); 
        $colaborador->cargo=$request->input('cargo'); 
        $colaborador->ubicacion=$request->input('ubicacion'); 
        $colaborador->sexo=$request->input('sexo'); 
        $colaborador->talla=$request->input('talla'); 
        $colaborador->talla_pantalon=$request->input('talla_pantalon'); 
        $colaborador->talla_zapatos=$request->input('talla_zapatos'); 
        $colaborador->tipo_contrato=$request->input('tipo-contrato'); 
        $colaborador->eps=$request->input('eps'); 
        $colaborador->pension=$request->input('pension'); 
        $colaborador->cesantias=$request->input('cesantias'); 
        $colaborador->salario=$request->input('salario'); 
        $colaborador->pension=$request->input('pension'); 
        $colaborador->alergias=$request->input('alergias'); 
        $colaborador->antecedentes=$request->input('antecedentes'); 
        $colaborador->nombre_contacto=$request->input('persona-contacto'); 
        $colaborador->telefono_contacto=$request->input('telefono-contacto'); 
        $colaborador->nombre_contacto_dos=$request->input('persona-contacto-dos'); 
        $colaborador->telefono_contacto_dos=$request->input('telefono-contacto-dos');
        $colaborador->rh=$request->input('rh'); 
        $colaborador->estado='activos'; 
        $colaborador->estado_civil=$request->input('estado_civil'); 
        $colaborador->vivienda=$request->input('vivienda'); 
        $colaborador->arl=$request->input('arl'); 
        $colaborador->caja_compensacion=$request->input('caja_compensacion'); 
        $colaborador->convenidos=$request->input('convenidos'); 
        $colaborador->medicina_prepagada=$request->input('medicina_prepagada'); 
        $colaborador->fecha_ingreso=$request->input('fecha_ingreso'); 
        $colaborador->password=bcrypt("123456");
        $colaborador->save();
        $rut=$request->file('rut');
        if($rut){
            $rut_path = time().$rut->getClientOriginalName();;
            Storage::disk('rut')->put($rut_path,\File::get($rut));
            $colaborador->rut=$rut_path;
        }
        //$correo = new RegistroMailable;
        //Mail::to($email)->send($correo);
        return back()->with(array(
            'message'=>'Colaborador Agregado'
        ));
    }

    public function actualizar($id,Request $request){
        $colaborador =  User::find($id);
        $colaborador->cedula=$request->input('cedula');
        $colaborador->name=$request->input('nombres');
        $colaborador->hijos=$request->input('hijos');
        $colaborador->lastname=$request->input('apellidos');
        $colaborador->telefono=$request->input('telefono'); 
        $colaborador->correo_personal=$request->input('correo-personal'); 
        $email=$colaborador->email=$request->input('correo'); 
        $colaborador->cumpleanos=$request->input('cumpleanos'); 
        $colaborador->direccion=$request->input('direccion'); 
        $colaborador->cargo=$request->input('cargo'); 
        $colaborador->ubicacion=$request->input('ubicacion'); 
        $colaborador->sexo=$request->input('sexo'); 
        $colaborador->talla=$request->input('talla'); 
        $colaborador->talla_pantalon=$request->input('talla_pantalon'); 
        $colaborador->talla_zapatos=$request->input('talla_zapatos'); 
        $colaborador->tipo_contrato=$request->input('tipo-contrato'); 
        $colaborador->eps=$request->input('eps'); 
        $colaborador->pension=$request->input('pension'); 
        $colaborador->cesantias=$request->input('cesantias'); 
        $colaborador->salario=$request->input('salario'); 
        $colaborador->pension=$request->input('pension'); 
        $colaborador->alergias=$request->input('alergias'); 
        $colaborador->antecedentes=$request->input('antecedentes'); 
        $colaborador->nombre_contacto=$request->input('persona-contacto'); 
        $colaborador->telefono_contacto=$request->input('telefono-contacto'); 
        $colaborador->nombre_contacto_dos=$request->input('persona-contacto-dos'); 
        $colaborador->telefono_contacto_dos=$request->input('telefono-contacto-dos');
        $colaborador->rh=$request->input('rh'); 
        $colaborador->estado='activos'; 
        $colaborador->estado_civil=$request->input('estado_civil'); 
        $colaborador->vivienda=$request->input('vivienda'); 
        $colaborador->arl=$request->input('arl'); 
        $colaborador->caja_compensacion=$request->input('caja_compensacion'); 
        $colaborador->convenidos=$request->input('convenidos'); 
        $colaborador->medicina_prepagada=$request->input('medicina_prepagada'); 
        $colaborador->fecha_ingreso=$request->input('fecha_ingreso'); 
        
        $rut=$request->file('rut');
        if($rut){
            $rut_path = time().$rut->getClientOriginalName();;
            Storage::disk('rut')->put($rut_path,\File::get($rut));
            $colaborador->rut=$rut_path;
        }
        $colaborador->update();
        return back()->with(array(
            'message'=>'Registro Actualizado'
        ));
    }

    public function actualizarPerfil($id,Request $request){
        $password=$request->input('password');
        $colaborador =  User::find($id);
        $colaborador->name=$request->input('nombre');
        $colaborador->lastname=$request->input('apellidos');
        $colaborador->cedula=$request->input('cedula');
        $colaborador->telefono=$request->input('telefono');
        $colaborador->correo_personal=$request->input('correo');
        $colaborador->direccion=$request->input('direccion');
        $colaborador->rh=$request->input('rh');
        $colaborador->cumpleanos=$request->input('fecha-nacimiento');
        if($password!=""){
            $colaborador->password=bcrypt($password);
        }
        $colaborador->alergias=$request->input('alergias');
        $colaborador->antecedentes=$request->input('antecedentes');
        $colaborador->nombre_contacto=$request->input('nombre-contacto');
        $colaborador->telefono_contacto=$request->input('telefono-contacto');
        $colaborador->nombre_contacto_dos=$request->input('nombre-contacto-dos'); 
        $colaborador->telefono_contacto_dos=$request->input('telefono-contacto-dos'); 

        $colaborador->cesantias=$request->input('cesantias'); 
        $colaborador->pension=$request->input('pension'); 
        $colaborador->arl=$request->input('arl'); 
        $colaborador->eps=$request->input('eps'); 
        $colaborador->caja_compensacion=$request->input('caja_compensacion'); 
        $colaborador->convenidos=$request->input('convenidos'); 
        $colaborador->medicina_prepagada=$request->input('medicina_prepagada'); 
        
        $imagen=$request->file('imagen');
        if($imagen){
            $imagen_path = time().$imagen->getClientOriginalName();;
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
        $colaborador->estado='retirados';
        $colaborador->update();
        return back()->with(array(
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

        $usuario=User::where('email','=',$request->input('correo'))->first();

        if($usuario){
            $message="Ya existe un usuario con este correo registrado";
        }
        else{
            $user->name=$request->input('nombre');
            $user->cargo=$request->input('cargo');
            $user->email=$request->input('correo');
            $user->password=bcrypt($request->input('password'));
            $user->companie_id=$companie_id;
            $user->role_id=5;
            $user->save();
            $message="Usuario Agregado Exitosamente";
        }
        return back()->with('message',$message);
    }

    public function updateusuarioempresa($id_user,Request $request){
        $usuario = User::find($id_user);
        $usuario->name=$request->input('nombre');
        $usuario->cargo=$request->input('cargo');
        $usuario->email=$request->input('correo');
        if($request->input('password')!=null){
            $usuario->password=bcrypt($request->input('password'));
        }
        $usuario->update();
        return back()->with('message','Usuario actualizado');

    }

    public function eliminiarusuarioempresa($idusuario){
        $usuario=User::find($idusuario);
        $usuario->delete();
        return back()->with('message','Usuario eliminado');
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
        $hijos=HijoColaborador::get()->where('id_colaborador','=',$id_user);
        $titulos = Titulo::where('id_contador','=',$id_user)
        ->join('tipo_documento','titulo.tipo_titulo','=','tipo_documento.idconfiguracion')->get();
        return view('colaboradores.perfiluser',array(
            'colaborador'=>$colaborador,
            'tipo_documentos'=>$tipo_documentos,
            'titulos'=>$titulos,
            'hijos'=>$hijos
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

    public function generarhojadevida($id){
        $educacion=Educacion::where('id_usuario','=',$id)->get();
        $formacion=Formacion::where('id_usuario','=',$id)->get();
        $experiencia=ExperienciaLaboral::where('id_usuario','=',$id)->get();
        $colaborador=User::where('id_contador','=',$id)->get();
        $pdf = PDF::loadView('reportes.hojadevida',compact(
            'educacion',
            'formacion',
            'experiencia',
            'colaborador'
        ));
        return $pdf->download('Hoja de vida.pdf');
    }

    public function retirar($id,Request $request){
        $colaborador=User::find($id);
        $colaborador->estado='retirados';
        $colaborador->update();
        $retiro = new Retiro();
        $retiro->id_colaborador=$id;
        $retiro->motivo=$request->input('motivo');
        $retiro->save();
        return back()->with('message','Colaborador retirado');
    }
    public function reingresar($id){
        $colaborador=User::find($id);
        $colaborador->estado='activos';
        $colaborador->update();
        $retiro = Retiro::where('id_colaborador','=',$id)->first();
        if($retiro){
            $retiro->delete();
        }
        return back()->with('message','Colaborador reingresado');
    }

    public function mostrarUsuarios($id){
       $usuarios = User::where('companie_id','=',$id)->get();
       return response(json_encode($usuarios),200)->header('Content-type','text/plain');
    }

   /* public function usercompanies(){
        $empresas=Empresa::get();
        foreach($empresas as $empresa){
            $user = new User();
            $user->name=$empresa->name_company;
            $user->email=$empresa->email_company;
            $user->password=bcrypt($empresa->nit_company);
            $user->role_id=5;
            $user->companie_id=$empresa->id_company;
            $user->save();
            $id_user =  User::latest('id_contador')->first();
            $empresa->user_id=$id_user->id_contador;
            $empresa->update();
        }
    }*/

    public function acontisitos(){
        $hijos = HijoColaborador::join('contadores','hijos_colaboradores.id_colaborador','=','contadores.id_contador')
        ->get();
        return view('colaboradores.acontisitos',array(
            'acontisitos'=>$hijos
        ));
    }

    public function reporte($estado){
        if($estado=="activos"){
            return Excel::download(new ColaboradoresExport,'reporte-colaboradores.xlsx');
        }
        else{
            return Excel::download(new ColaboradoresExportRetirados,'reporte-colaboradores.xlsx');
        }
    }

    

}
