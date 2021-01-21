<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaContador extends Model
{
    protected $table = 'companies_contadores';
    public function getKeyName(){
        return "id_companycontador";
    }
    use HasFactory;
}
