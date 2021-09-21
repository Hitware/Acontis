<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionProveedor extends Model
{
    protected $table = 'evaluacion_proveedor';
    public function getKeyName(){
        return "id_evaluacion";
    }
    use HasFactory;
}
