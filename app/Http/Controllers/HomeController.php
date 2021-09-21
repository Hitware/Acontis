<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Notificaciones;
use App\Models\Empresa;
use App\Models\Servicio;
use App\Models\Clasificacion;
use App\Models\Evento;
use App\Models\Sede;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $empresas=Empresa::get();
            $servicios=Servicio::get();
            $eventos=Evento::get();
            $sedes=Sede::get();
            return view('inicio.index',array(
                'empresas'=>$empresas,
                'servicios'=>$servicios,
                'eventos'=>$eventos,
                'sedes'=>$sedes
            ));
    }

    public function colaboradores(){
        return view('colaboradores.colaboradores');
    }

}
