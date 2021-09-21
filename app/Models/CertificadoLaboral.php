<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoLaboral extends Model
{
    protected $table = 'certificado_laboral';
    
    public function getKeyName(){
        return "id_certificado";
    }
    use HasFactory;
}
