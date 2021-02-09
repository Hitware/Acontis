<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaPorCobrarDetallada extends Model
{
    use HasFactory;

    protected $table = 'dbo.Vista_CuentasPorCobrar_Detallada';


    protected $appends = ['full_documento'];

    public function getFullDocumentoAttribute()
    {
        return trim($this->attributes['prefijo'] ." " . $this->attributes["DocumentoNúmero"]);
    }
    
}
