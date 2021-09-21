<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function index($estado){
        $proveedores=Proveedor::where('estado','=',$estado)->get();
        return view('proveedores.index',array(
            'proveedores'=>$proveedores
        ));
    }

    public function agregar(Request $request){
        $proveedor = new Proveedor();
        $proveedor->nombre=$request->input('nombre');
        $proveedor->cedula=$request->input('cedula');
        $proveedor->nit=$request->input('nit');
        $proveedor->servicio=$request->input('servicio');
        $proveedor->persona_contacto=$request->input('nombre-contacto');
        $proveedor->telefono_contacto=$request->input('telefono');
        $proveedor->correo=$request->input('correo');
        $proveedor->estado="activos";
        $comercio=$request->file('comercio');
        $rut=$request->file('rut');
        $cedula=$request->file('cedula-file');
        $referencia=$request->file('referencia-bancaria');
        $seguridad=$request->file('seguridad-social');
        $sig=$request->file('sig');
        if($comercio){
            $comercio_path = time().$comercio->getClientOriginalName();
            Storage::disk('camaracomercio')->put($comercio_path,\File::get($comercio));
            $proveedor->url_comercio=$comercio_path;
        }
        if($rut){
            $rut_path = time().$rut->getClientOriginalName();
            Storage::disk('rut')->put($rut_path,\File::get($rut));
            $proveedor->url_rut=$rut_path;
        }
        if($cedula){
            $cedula_path = time().$cedula->getClientOriginalName();
            Storage::disk('cedula')->put($cedula_path,\File::get($cedula));
            $proveedor->url_cedula=$cedula_path;
        }
        if($referencia){
            $referencia_path = time().$referencia->getClientOriginalName();
            Storage::disk('referencia')->put($referencia_path,\File::get($referencia));
            $proveedor->url_referencia=$referencia_path;
        }
        if($seguridad){
            $seguridad_path = time().$seguridad->getClientOriginalName();
            Storage::disk('seguridad')->put($seguridad_path,\File::get($seguridad));
            $proveedor->url_seguridad_social=$seguridad_path;
        }
        if($sig){
            $sig_path = time().$sig->getClientOriginalName();
            Storage::disk('sig')->put($sig_path,\File::get($sig));
            $proveedor->url_sig=$sig_path;
        }
        $proveedor->save();
        return back()->with('message','Proveedor agregado');
    }

    public function actualizar($id,Request $request){
        $proveedor=Proveedor::find($id);
        $proveedor->nombre=$request->input('nombre');
        $proveedor->cedula=$request->input('cedula');
        $proveedor->nit=$request->input('nit');
        $proveedor->servicio=$request->input('servicio');
        $proveedor->persona_contacto=$request->input('nombre-contacto');
        $proveedor->telefono_contacto=$request->input('telefono');
        $proveedor->correo=$request->input('correo');
        $proveedor->estado="activos";
        $comercio=$request->file('comercio');
        $rut=$request->file('rut');
        $cedula=$request->file('cedula-file');
        $referencia=$request->file('referencia-bancaria');
        $seguridad=$request->file('seguridad-social');
        $sig=$request->file('sig');
        if($comercio){
            $comercio_path = time().$comercio->getClientOriginalName();
            Storage::disk('camaracomercio')->put($comercio_path,\File::get($comercio));
            $proveedor->url_comercio=$comercio_path;
        }
        if($rut){
            $rut_path = time().$rut->getClientOriginalName();
            Storage::disk('rut')->put($rut_path,\File::get($rut));
            $proveedor->url_rut=$rut_path;
        }
        if($cedula){
            $cedula_path = time().$cedula->getClientOriginalName();
            Storage::disk('cedula')->put($cedula_path,\File::get($cedula));
            $proveedor->url_cedula=$cedula_path;
        }
        if($referencia){
            $referencia_path = time().$referencia->getClientOriginalName();
            Storage::disk('referencia')->put($referencia_path,\File::get($referencia));
            $proveedor->url_referencia=$referencia_path;
        }
        if($seguridad){
            $seguridad_path = time().$seguridad->getClientOriginalName();
            Storage::disk('seguridad')->put($seguridad_path,\File::get($seguridad));
            $proveedor->url_seguridad_social=$seguridad_path;
        }
        if($sig){
            $sig_path = time().$sig->getClientOriginalName();
            Storage::disk('sig')->put($sig_path,\File::get($sig));
            $proveedor->url_sig=$sig_path;
        }
        $proveedor->update();
        return back()->with('message','Proveedor retirado');
        
    }

    public function eliminar($id,Request $request){
        $proveedor=Proveedor::find($id);
        $proveedor->estado="retirados";
        $proveedor->retiro=$request->input('retiro');
        $proveedor->update();
        return back()->with('message','Proveedor retirado');
        
    }

    public function getComercio($filename){
        return Storage::response("camaracomercio/$filename");
    }

    public function getCedula($filename){
        return Storage::response("cedula/$filename");
    }

    public function getRut($filename){
        return Storage::response("rut/$filename");
    }

    public function getReferencia($filename){
        return Storage::response("referencia/$filename");
    }

    public function getSeguridad($filename){
        return Storage::response("seguridad/$filename");
    }

    public function getSig($filename){
        return Storage::response("sig/$filename");
    }
}
