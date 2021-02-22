<?php

namespace App\Http\View\Composers;

use App\Models\Notificaciones;
use Illuminate\View\View;

class NotificacionComposer
{
   public function compose(View $view)
    {
        $role=null;

        if($id_user=auth()->user()!=''){
            if($id_user=='3' or $id_user=='4'){
                $role=1;
            }
            else if($id_user==5){
                $role=2;
            }
            $view->with('notifications', Notificaciones::where('tipo','=',$role)->get());
        }
        else{
            $view->with('notifications', Notificaciones::get());

        }
        
        
    }
}