<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetiroEmpresa extends Model
{
    use HasFactory;
    protected $table = 'empresa_retiro';

    public function getKeyName(){
        return "id_retiroempresa";
    }
}
