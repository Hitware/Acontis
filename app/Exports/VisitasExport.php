<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Visita;

class VisitasExport implements FromView
{
    private $inicio;
    private $final;

    public function __construct($inicio,$final){
        $this->inicio = $inicio;
        $this->final = $final;
    }

    /**
    * @return \Illuminate\Database\Query\Builder
    */

    use Exportable;

    public function view(): View{
        return view('reportes.indicadores.visitas',
        ['visitas'=>Visita::
        join('contadores','evento.id_contador','=','contadores.id_contador')
        ->join('companies','evento.id_empresa','=','companies.id_company')
        ->whereDate('fecha','>=',$this->inicio)]
        );
    }

    public function query()
    {
        return Visita::
        join('contadores','evento.id_contador','=','contadores.id_contador')
        ->join('companies','evento.id_empresa','=','companies.id_company')
        ->whereDate('fecha','>=',$this->inicio);
    }
}
