<?php

namespace App\Http\View\Composers;

use App\Models\Notificaciones;
use App\Models\Sede;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\View\View;

class NotificacionComposer
{
   public function compose(View $view)
    {
        $role=null;

        if(request()->route()->named("generar-pdf-empresa") ?? false) {
            return;
        }
        
        if($id_user=auth()->user()!=''){
            if($id_user=='3' or $id_user=='4'){
                $role = 1;
            }
            else if($id_user==5){
                $role=2;
            }
            if(auth()->user()->id_companie!=null){
                $idc=auth()->user()->id_companie;
                $view->with('notifications', Notificaciones::where('tipo','=',$role)->get());
                $view->with('empresal', Empresa::where('id_company','=',$idc)->get());
                $view->with('sedes', Sede::get());
            }
            else{
                $view->with('notifications', Notificaciones::where('tipo','=',$role)->get());
                $view->with('sedes', Sede::get());
            }
            
        }
        else{
            $view->with('notifications', Notificaciones::get());
        }
        
        
    }
}