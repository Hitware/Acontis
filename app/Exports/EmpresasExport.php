<?php

namespace App\Exports;

use App\Models\Empresa;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmpresasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return Empresa::select("name_company","nit_company","telephone_company","email_company","tipo_cliente","servicio","representante_legal")->get();
    
    }

    public function view(): View{
        return view('reportes.indicadores.empresas',
        ['empresas'=>Empresa::get()]
        );
    }
}
