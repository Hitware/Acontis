<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\User;
class ColaboradoresExport implements FromView
{
    /**
    * @return \Illuminate\Database\Query\Builder
    */
   

    public function view(): View{
        return view('reportes.colaboradores.colaboradores',
        ['colaboradores'=>User::where('role_id','=','3')
        ->orWhere('role_id','=','4')
        ->get()]
        );
    }
}
