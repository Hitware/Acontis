<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;
    protected $table = 'tipoclientes';

    public function getKeyName(){
        return "id_tipocliente";
    }
    
}
